<?php
namespace PaymentsGate;

use Exception;
use PaymentsGate\Exceptions\ErrorConfigEndpointInvalidUrl;
use PaymentsGate\Exceptions\ErrorConfigFileNotParsed;
use PaymentsGate\Exceptions\ErrorConfigMismatch;
use PaymentsGate\Exceptions\ErrorForbiddenRequest;
use PaymentsGate\Exceptions\ErrorRequestProcessed;
use PaymentsGate\Exceptions\ErrorUnauthorizedRequest;

class ApiClient {
    private string $endpointUrl;
    private string $hostname;
    private bool $debug = false;
    
    private ?string $projectId = null;
    private ?string $merchantId = null;
    private ?string $realm = null;

    // Static store mimicking the Node.js Map store
    private static string $accessToken = '';
    private static string $refreshToken = '';
    private static string $publicKey = '';
    private static string $privateKey = '';
    private static string $accountId = '';

    public function __construct(array $config) {
        if (empty($config['endpoint'])) {
            throw new ErrorConfigEndpointInvalidUrl("Url is empty");
        }

        $this->endpointUrl = rtrim($config['endpoint'], '/');
        $this->hostname = parse_url($this->endpointUrl, PHP_URL_HOST) ?? '';

        if (isset($config['filepath'])) {
            $this->loadFromFile($config['filepath']);
            return;
        }

        if (isset($config['publicKey'], $config['privateKey'], $config['accountId'])) {
            self::$publicKey = $config['publicKey'];
            self::$privateKey = $config['privateKey'];
            self::$accountId = $config['accountId'];
            return;
        }

        throw new ErrorConfigMismatch("Configuration mismatch");
    }

    private function loadFromFile(string $filepath): void {
        if (!file_exists($filepath)) {
            throw new ErrorConfigFileNotParsed("File not found: " . $filepath);
        }

        $parsed = json_decode(file_get_contents($filepath), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ErrorConfigFileNotParsed("JSON parse error");
        }

        if (empty($parsed['account_id'])) throw new ErrorConfigFileNotParsed("account_id is empty");
        if (empty($parsed['public_key'])) throw new ErrorConfigFileNotParsed("public_key is empty");
        if (empty($parsed['private_key'])) throw new ErrorConfigFileNotParsed("private_key is empty");

        $this->projectId = $parsed['project_id'] ?? null;
        $this->merchantId = $parsed['merchant_id'] ?? null;
        $this->realm = $parsed['realm'] ?? null;

        self::$accountId = $parsed['account_id'];
        self::$publicKey = $parsed['public_key'];
        self::$privateKey = $parsed['private_key'];
    }

    public function setDebug(bool $debug): void {
        $this->debug = $debug;
    }

    // --- API Endpoints ---

    public function getAssets(): array {
        return $this->call('GET', Constants::ENDPOINTS['assets']['list']);
    }

    public function getDepositAddress(): array {
        return $this->call('GET', Constants::ENDPOINTS['assets']['deposit'] . '?currencyId=' . Constants::PRIMARY_CRYPTO_CURRENCY_ID);
    }

    public function getBanks(array $params = []): array {
        $query = !empty($params) ? '?' . http_build_query($params) : '';
        return $this->call('GET', Constants::ENDPOINTS['banks']['list'] . $query);
    }

    public function createPayIn(array $params): array {
        return $this->call('POST', Constants::ENDPOINTS['invoices']['payin'], $params);
    }

    public function getStatus(string $id): array {
        $path = sprintf(Constants::ENDPOINTS['invoices']['info'], urlencode($id));
        return $this->call('GET', $path);
    }

    public function createPayOut(array $params): array {
        return $this->call('POST', Constants::ENDPOINTS['invoices']['payout'], $params);
    }

    public function createTlv(array $params): array {
        return $this->call('POST', Constants::ENDPOINTS['invoices']['tlv'], $params);
    }

    public function getInvoiceCredentials(string $id): array {
        $path = sprintf(Constants::ENDPOINTS['invoices']['credentials'], urlencode($id));
        return $this->call('GET', $path);
    }

    public function quote(array $params): array {
        return $this->call('POST', Constants::ENDPOINTS['fx']['quoteNew'], $params);
    }

    public function quoteTlv(array $params): array {
        return $this->call('POST', Constants::ENDPOINTS['fx']['quoteTlv'], $params);
    }

    // --- Internal Logic ---

    private function updateToken(bool $isRenew = false): void {
        if (self::$accessToken && !$isRenew) {
            $parts = explode('.', self::$accessToken);
            if (count($parts) === 3) {
                $payload = json_decode(base64_decode($parts[1]), true);
                $exp = $payload['exp'] ?? 0;
                if ($exp > time()) {
                    return; // Token not expired
                }
            }
        }

        if (self::$refreshToken) {
            try {
                $result = $this->doRequest('POST', Constants::ENDPOINTS['token']['refresh'], [
                    'refresh_token' => self::$refreshToken
                ], false);
                self::$accessToken = $result['access_token'];
                self::$refreshToken = $result['refresh_token'];
                return;
            } catch (ErrorUnauthorizedRequest $e) {
                if ($isRenew) throw $e;
                self::$accessToken = '';
                self::$refreshToken = '';
                $this->updateToken(true);
                return;
            }
        }

        self::$accessToken = '';
        self::$refreshToken = '';

        $result = $this->doRequest('POST', Constants::ENDPOINTS['token']['issue'], [
            'account_id' => self::$accountId,
            'public_key' => self::$publicKey
        ], false);

        self::$accessToken = $result['access_token'] ?? '';
        self::$refreshToken = $result['refresh_token'] ?? '';
    }

    private function call(string $method, string $path, array $payload = []): array {
        $this->updateToken();
        
        try {
            return $this->doRequest($method, $path, $payload, true);
        } catch (ErrorUnauthorizedRequest $e) {
            $this->updateToken();
            return $this->doRequest($method, $path, $payload, true);
        }
    }

    private function doRequest(string $method, string $path, array $payload = [], bool $useAuth = true): array {
        $url = $this->endpointUrl . $path;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = [
            'Accept: application/json',
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            'User-Agent: ' . Constants::USER_AGENT,
            'Host: ' . $this->hostname,
            'Origin: https://' . $this->hostname
        ];

        if ($useAuth && self::$accessToken) {
            $headers[] = 'Authorization: Bearer ' . self::$accessToken;
        }

        if ($method !== 'GET' && !empty($payload)) {
            $jsonPayload = json_encode($payload);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($this->debug) {
            // Optional: add cURL debug logging
            curl_setopt($ch, CURLOPT_VERBOSE, true);
        }

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        if ($response === false) {
            throw new ErrorRequestProcessed("cURL Error: " . $error, ['path' => $path]);
        }

        $data = json_decode($response, true) ?? [];

        if ($statusCode >= 302 && isset($data['error'])) {
            throw new ErrorRequestProcessed($data['message'] ?? 'Unknown API Error', $data, $statusCode);
        }

        if ($statusCode === 401 || $statusCode === 400) {
            throw new ErrorUnauthorizedRequest("Unauthorized request", ['payload' => $payload], 401);
        }

        if ($statusCode === 403) {
            throw new ErrorForbiddenRequest("Request not allowed", ['payload' => $payload], 403);
        }

        if ($statusCode === 429) {
            throw new ErrorRequestProcessed("Rate limited", ['payload' => $payload], 429);
        }

        if ($statusCode >= 300) {
            throw new ErrorRequestProcessed("Unknown error", ['payload' => $payload], $statusCode);
        }

        return $data;
    }
}