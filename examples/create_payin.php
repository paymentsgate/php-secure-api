<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PaymentsGate\ApiClient;
use PaymentsGate\Exceptions\ApiClientException;

$config = require __DIR__ . '/config.php';

$client = new ApiClient($config);

try {
    $result = $client->createPayIn([
        'amount'     => 10,
        'currency'   => 'AZN',
        'invoiceId'  => (string) round(microtime(true) * 1000),
        'clientId'   => (string) round(microtime(true) * 1000),
        'successUrl' => 'https://example.com/success',
        'failUrl'    => 'https://example.com/fail',
        'type'       => 'p2p'
    ]);

    print_r($result);

} catch (ApiClientException $e) {
    echo "API Error: " . $e->getMessage() . PHP_EOL;
    if (!empty($e->data)) {
        print_r($e->data);
    }
} catch (\Exception $e) {
    echo "System error: " . $e->getMessage() . PHP_EOL;
}