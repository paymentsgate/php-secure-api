# Payments Gate PHP Client

This is a complete PHP SDK for communication with the paymentsgate service.

## Features

- PayIn orders with our own widget (redirect)
- PayIn H2H (sync and async mode)
- PayOut orders
- Quotes (pre-payout quote calculate)
- Account balance with pending funds
- TRC20 deposit address requests

## Requirements & Dependencies

- **PHP 8.1** or higher
- `ext-curl` - native PHP extension for HTTP requests
- `ext-json` - native PHP extension for JSON payload manipulation

## Installation

You can install the package via composer:

```sh
composer require paymentsgate/php-secure-api

```

## Usage

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use PaymentsGate\ApiClient;

$client = new ApiClient([
    'endpoint' => '[https://api.example.com](https://api.example.com)',
    'filepath' => __DIR__ . '/credentials.json'
]);

//// .......... ////

$result = $client->createPayIn([
    'amount'     => 10,
    'currency'   => 'AZN',
    'invoiceId'  => (string) round(microtime(true) * 1000),
    'clientId'   => (string) round(microtime(true) * 1000),
    'successUrl' => '[https://example.com/success](https://example.com/success)',
    'failUrl'    => '[https://example.com/fail](https://example.com/fail)',
    'type'       => 'p2p'
]);

print_r($result);

```

The `credentials.json` file is used to connect to the client and contains all necessary data to use the API.
This file can be obtained in your personal cabinet, in the service accounts section. Follow the instructions in the documentation to issue new keys.

If you already have keys, but you don't feel comfortable storing them in a file, you can use client initialization via variables. In this case, the key data can be stored in environment variables (like `.env`) or external storage instead of on the file system:

```php
<?php

use PaymentsGate\ApiClient;

$client = new ApiClient([
    'endpoint'   => '[https://api.example.com](https://api.example.com)',
    'accountId'  => '00000000-4000-4000-0000-00000000000a',
    'publicKey'  => 'LS0tLS1CRUdJTiBSU0EgUFJJVkFUNSUlFb3dJQk....',
    'privateKey' => 'LS0tLS1CRUdJTiklqQU5CZ2txaGtpRzl3MEJBUUV....'
]);

```

_It is important to note that the data format for key transfer is base64._

## Examples

**Request QUOTE**

```php
$result = $client->quote([
    'currency_from' => 'USDT',
    'currency_to'   => 'AZN',
    'amount'        => 5.20,
]);

```

Response:

```json
{
  "id": "6462c5d3-3a50-4b7f-aae4-8e2e909d7a35",
  "finalAmount": 8.41,
  "direction": "C2F",
  "fullRate": 1.78,
  "fullRateReverse": 0.021,
  "fees": 0.5,
  "fees_percent": 0.012,
  "quotes": [
    {
      "currencyFrom": "USDT",
      "currencyTo": "AZN",
      "pair": "USDT/AZN",
      "rate": 1.69
    }
  ]
}
```

**Use QUOTE response for next request**

```php
$result = $client->createPayOut([
    'currencyTo'   => 'EUR',
    'amount'       => 5.20,
    'baseCurrency' => 'fiat',
    'feesStrategy' => 'add',
    'invoiceId'    => 'INVOICE-112123123',
    'recipient'    => [
        'account_number' => '4000000000000012',
        'account_owner'  => 'CARD HOLDER',
        'type'           => 'card'
    ],
    'quoteId'      => '6462c5d3-3a50-4b7f-aae4-8e2e909d7a35'
]);

```

## Available currencies

`USDT
EUR
USD
TRY
CNY
JPY
GEL
AZN
INR
AED
KZT
UZS
TJS
EGP
PKR
IDR
BDT
GBP
RUB
THB
KGS
PHP
ZAR
ARS
GHS
KES
NGN
AMD
BYN
TRX
ETH
XOF
CAD
AFN
ALL
AUD
BAM
BGN
BHD
BIF
BND
BOB
BRL
BWP
BZD
CDF
CHF
CLP
COP
CRC
CVE
CZK
DJF
DKK
DOP
DZD
EEK
ERN
ETB
GNF
GTQ
HKD
HNL
HRK
HUF
ILS
IQD
IRR
ISK
JMD
JOD
KHR
KMF
KRW
KWD
LBP
LKR
LTL
LVL
LYD
MAD
MDL
MGA
MKD
MMK
MNT
MOP
MUR
MXN
MYR
MZN
NAD
NIO
NOK
NPR
NZD
OMR
PAB
PEN
PLN
PYG
QAR
RON
RSD
RWF
SAR
SDG
SEK
SGD
SOS
SYP
TND
TOP
TTD
TWD
TZS
UAH
UGX
UYU
VEF
VND
YER
ZMK`

## Available payment methods

`p2p
c2c
m10
mpay
sbp
sbpqr
iban
upi
imps
spei
pix
rps
ibps
bizum
rkgs
kgsphone
krungthainext
sber
kztphone
bkash
nagad
alipay
accountegp
accountphp
sberqr
maya
gcash
banktransferphp
banktransferars
phonepe
freecharge
instapay
instapayqr
vodafonecash
orangecash
razn
rtjs
skzt
scny
vtbcny
sgel
seur
stry
sthb
sberpay
sberpay_s
tpay
opay
moniepoint
palmpay
wave
orangemoney
orangemoneyjod
moovmoney
rtjscard
ruzs
amobile
payid
baridi
multiwidget
banktransfermad
cih
cashplus
elqr
odengi
banktransferdop
sinpemovil
tryqr
bsb
banktransfermnt
stcpay
upiqr
ifsc
tjsbank
sortgbp
unionpay
ecomazn
ecomrub
banktransferthb
banktransferzar
dcecomusd
dcecomeur
benefitpay
cliq
papara
blik
promptpayqr
applepay
ideal
napas
vndqr
inrqr
egpqr
oneclick
thaiqr
mobilecom
banktransferuyu
banktransferngn
mpesa
airtel
equitel
fib`
