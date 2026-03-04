<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PaymentsGate\ApiClient;
use PaymentsGate\Exceptions\ApiClientException;

$config = require __DIR__ . '/config.php';

$client = new ApiClient($config);

try {
    $result = $client->quote([
        'currency_from' => 'RUB',
        'currency_to'   => 'EUR',
        'amount'        => 5.2,
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