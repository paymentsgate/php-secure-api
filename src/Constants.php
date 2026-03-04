<?php
namespace PaymentsGate;

class Constants {
    public const USER_AGENT = 'paymentsgate.php-secure-api';
    public const PRIMARY_CRYPTO_CURRENCY_ID = 'ccbfac34-75d1-4fad-ba78-4583f4207ffe';

    public const ENDPOINTS = [
        'token' => [
            'issue' => '/auth/token',
            'refresh' => '/auth/token/refresh',
        ],
        'invoices' => [
            'payin' => '/deals/payin',
            'payout' => '/deals/payout',
            'tlv' => '/deals/tlv',
            'info' => '/deals/%s',
            'credentials' => '/deals/%s/credentials',
        ],
        'assets' => [
            'list' => '/wallet',
            'deposit' => '/wallet/deposit',
        ],
        'banks' => [
            'list' => '/banks/find',
        ],
        'fx' => [
            'quoteNew' => '/fx/calculatenew',
            'quoteTlv' => '/fx/tlv',
        ]
    ];
}

