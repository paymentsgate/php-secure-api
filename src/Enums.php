<?php
namespace PaymentsGate\Enums;

enum AuthenticationRealms: string {
    case PRODUCTION = 'production';
    case SANDBOX = 'sandbox';
}

enum Currencies: string {
    case USDT = 'USDT';
    case EUR = 'EUR';
    case USD = 'USD';
    case TRY = 'TRY';
    case CNY = 'CNY';
    case JPY = 'JPY';
    case GEL = 'GEL';
    case AZN = 'AZN';
    case INR = 'INR';
    case AED = 'AED';
    case KZT = 'KZT';
    case UZS = 'UZS';
    case TJS = 'TJS';
    case EGP = 'EGP';
    case PKR = 'PKR';
    case IDR = 'IDR';
    case BDT = 'BDT';
    case GBP = 'GBP';
    case RUB = 'RUB';
    case THB = 'THB';
    case KGS = 'KGS';
    case PHP = 'PHP';
    case ZAR = 'ZAR';
    case ARS = 'ARS';
    case GHS = 'GHS';
    case KES = 'KES';
    case NGN = 'NGN';
    case AMD = 'AMD';
    case BYN = 'BYN';
    case TRX = 'TRX';
    case ETH = 'ETH';
    case XOF = 'XOF';
    case CAD = 'CAD';
    case AFN = 'AFN';
    case ALL = 'ALL';
    case AUD = 'AUD';
    case BAM = 'BAM';
    case BGN = 'BGN';
    case BHD = 'BHD';
    case BIF = 'BIF';
    case BND = 'BND';
    case BOB = 'BOB';
    case BRL = 'BRL';
    case BWP = 'BWP';
    case BZD = 'BZD';
    case CDF = 'CDF';
    case CHF = 'CHF';
    case CLP = 'CLP';
    case COP = 'COP';
    case CRC = 'CRC';
    case CVE = 'CVE';
    case CZK = 'CZK';
    case DJF = 'DJF';
    case DKK = 'DKK';
    case DOP = 'DOP';
    case DZD = 'DZD';
    case EEK = 'EEK';
    case ERN = 'ERN';
    case ETB = 'ETB';
    case GNF = 'GNF';
    case GTQ = 'GTQ';
    case HKD = 'HKD';
    case HNL = 'HNL';
    case HRK = 'HRK';
    case HUF = 'HUF';
    case ILS = 'ILS';
    case IQD = 'IQD';
    case IRR = 'IRR';
    case ISK = 'ISK';
    case JMD = 'JMD';
    case JOD = 'JOD';
    case KHR = 'KHR';
    case KMF = 'KMF';
    case KRW = 'KRW';
    case KWD = 'KWD';
    case LBP = 'LBP';
    case LKR = 'LKR';
    case LTL = 'LTL';
    case LVL = 'LVL';
    case LYD = 'LYD';
    case MAD = 'MAD';
    case MDL = 'MDL';
    case MGA = 'MGA';
    case MKD = 'MKD';
    case MMK = 'MMK';
    case MNT = 'MNT';
    case MOP = 'MOP';
    case MUR = 'MUR';
    case MXN = 'MXN';
    case MYR = 'MYR';
    case MZN = 'MZN';
    case NAD = 'NAD';
    case NIO = 'NIO';
    case NOK = 'NOK';
    case NPR = 'NPR';
    case NZD = 'NZD';
    case OMR = 'OMR';
    case PAB = 'PAB';
    case PEN = 'PEN';
    case PLN = 'PLN';
    case PYG = 'PYG';
    case QAR = 'QAR';
    case RON = 'RON';
    case RSD = 'RSD';
    case RWF = 'RWF';
    case SAR = 'SAR';
    case SDG = 'SDG';
    case SEK = 'SEK';
    case SGD = 'SGD';
    case SOS = 'SOS';
    case SYP = 'SYP';
    case TND = 'TND';
    case TOP = 'TOP';
    case TTD = 'TTD';
    case TWD = 'TWD';
    case TZS = 'TZS';
    case UAH = 'UAH';
    case UGX = 'UGX';
    case UYU = 'UYU';
    case VEF = 'VEF';
    case VND = 'VND';
    case YER = 'YER';
    case ZMK = 'ZMK';
}

enum Languages: string {
    case EN = 'EN';
    case IN = 'IN';
    case AE = 'AE';
    case TR = 'TR';
    case GE = 'GE';
    case RU = 'RU';
    case UZ = 'UZ';
    case AZ = 'AZ';
    case AR = 'AR';
    case KG = 'KG';
    case ES = 'ES';
    case TG = 'TG';
    case MN = 'MN';
}

enum Statuses: string {
    case QUEUED = 'queued';
    case NEW = 'new';
    case PENDING = 'pending';
    case PAID = 'paid';
    case COMPLETED = 'completed';
    case DISPUTED = 'disputed';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';
    case EXPIRED = 'expired';
}

enum CurrencyTypes: string {
    case FIAT = 'fiat';
    case CRYPTO = 'crypto';
}

enum InvoiceTypes: string {
    case P2P = 'p2p';
    case C2C = 'c2c';
    case M10 = 'm10';
    case MPAY = 'mpay';
    case SBP = 'sbp';
    case SBPQR = 'sbpqr';
    case IBAN = 'iban';
    case UPI = 'upi';
    case IMPS = 'imps';
    case SPEI = 'spei';
    case PIX = 'pix';
    case RPS = 'rps';
    case IBPS = 'ibps';
    case BIZUM = 'bizum';
    case RKGS = 'rkgs';
    case KGSPHONE = 'kgsphone';
    case KRUNGTHAINEXT = 'krungthainext';
    case SBER = 'sber';
    case KZTPHONE = 'kztphone';
    case BKASH = 'bkash';
    case NAGAD = 'nagad';
    case ALIPAY = 'alipay';
    case ACCOUNTEGP = 'accountegp';
    case ACCOUNTPHP = 'accountphp';
    case SBERQR = 'sberqr';
    case MAYA = 'maya';
    case GCASH = 'gcash';
    case BANKTRANSFERPHP = 'banktransferphp';
    case BANKTRANSFERARS = 'banktransferars';
    case PHONEPE = 'phonepe';
    case FREECHARGE = 'freecharge';
    case INSTAPAY = 'instapay';
    case INSTAPAYQR = 'instapayqr';
    case VODAFONECASH = 'vodafonecash';
    case ORANGECASH = 'orangecash';
    case RAZN = 'razn';
    case RTJS = 'rtjs';
    case SKZT = 'skzt';
    case SCNY = 'scny';
    case VTBCNY = 'vtbcny';
    case SGEL = 'sgel';
    case SEUR = 'seur';
    case STRY = 'stry';
    case STHB = 'sthb';
    case SBERPAY = 'sberpay';
    case SBERPAY_S = 'sberpay_s';
    case TPAY = 'tpay';
    case OPAY = 'opay';
    case MONIEPOINT = 'moniepoint';
    case PALMPAY = 'palmpay';
    case WAVE = 'wave';
    case ORANGEMONEY = 'orangemoney';
    case ORANGEMONEYJOD = 'orangemoneyjod';
    case MOOVMONEY = 'moovmoney';
    case RTJSCARD = 'rtjscard';
    case RUZS = 'ruzs';
    case AMOBILE = 'amobile';
    case PAYID = 'payid';
    case BARIDI = 'baridi';
    case MULTIWIDGET = 'multiwidget';
    case BANKTRANSFERMAD = 'banktransfermad';
    case CIH = 'cih';
    case CASHPLUS = 'cashplus';
    case ELQR = 'elqr';
    case ODENGI = 'odengi';
    case BANKTRANSFERDOP = 'banktransferdop';
    case SINPEMOVIL = 'sinpemovil';
    case TRYQR = 'tryqr';
    case BSB = 'bsb';
    case BANKTRANSFERMNT = 'banktransfermnt';
    case STCPAY = 'stcpay';
    case UPIQR = 'upiqr';
    case IFSC = 'ifsc';
    case TJSBANK = 'tjsbank';
    case SORTGBP = 'sortgbp';
    case UNIONPAY = 'unionpay';
    case ECOMAZN = 'ecomazn';
    case ECOMRUB = 'ecomrub';
    case BANKTRANSFERTHB = 'banktransferthb';
    case BANKTRANSFERZAR = 'banktransferzar';
    case DCECOMUSD = 'dcecomusd';
    case DCECOMEUR = 'dcecomeur';
    case BENEFITPAY = 'benefitpay';
    case CLIQ = 'cliq';
    case PAPARA = 'papara';
    case BLIK = 'blik';
    case PROMPTPAYQR = 'promptpayqr';
    case APPLEPAY = 'applepay';
    case IDEAL = 'ideal';
    case NAPAS = 'napas';
    case VNDQR = 'vndqr';
    case INRQR = 'inrqr';
    case EGPQR = 'egpqr';
    case ONECLICK = 'oneclick';
    case THAIQR = 'thaiqr';
    case MOBILECOM = 'mobilecom';
    case BANKTRANSFERUYU = 'banktransferuyu';
    case BANKTRANSFERNGN = 'banktransferngn';
    case MPESA = 'mpesa';
    case AIRTEL = 'airtel';
    case EQUITEL = 'equitel';
    case FIB = 'fib';
}

enum EELQRBankALias: string {
    case BAKAI = 'bakai';
    case MBANK = 'mbank';
    case OPTIMA = 'optima';
    case KICB = 'kicb';
    case ODENGI = 'odengi';
    case DEMIR = 'demir';
    case MEGAPAY = 'megapay';
}

enum CredentialsTypes: string {
    case IBAN = 'iban';
    case PHONE = 'phone';
    case CARD = 'card';
    case FPS = 'fps';
    case QR = 'qr';
    case ACCOUNT = 'account';
    case CUSTOM = 'custom';
}

enum RiskScoreLevels: string {
    case UNCLASSIFIED = 'unclassified';
    case HR = 'hr';
    case FTD = 'ftd';
    case TRUSTED = 'trusted';
    case MIXED = 'mixed';
}

enum CancellationReason: string {
    case NO_MONEY = 'NO_MONEY';
    case CREDENTIALS_INVALID = 'CREDENTIALS_INVALID';
    case EXPIRED = 'EXPIRED';
    case PRECHARGE_GAP_UPPER_LIMIT = 'PRECHARGE_GAP_UPPER_LIMIT';
    case CROSS_BANK_TFF_LESS_THAN_3K = 'CROSS_BANK_TFF_LESS_THAN_3K';
    case CROSS_BANK_UNSUPPORTED = 'CROSS_BANK_UNSUPPORTED';
    case ACCOUNT_NUMBER_BLACKLISTED = 'ACCOUNT_NUMBER_BLACKLISTED';
    case ANTISPAM = 'ANTISPAM';
    case BY_CLIENT = 'BY_CLIENT';
    case BY_EXPIRATION = 'BY_EXPIRATION';
    case PAID_CANCEL_BY_EXPIRATION = 'PAID_BY_EXPIRATION';
    case DIRECT_MATCH_WITHOUT_MATCH_FLOW_FAILED = 'DIRECT_MATCH_WITHOUT_MATCH_FLOW_FAILED';
    case REFUNDED = 'REFUNDED';
}

enum FeesStrategy: string {
    case ADD = 'add';
    case SUB = 'sub';
}

enum InvoiceDirection: string {
    case F2C = 'F2C';
    case C2F = 'C2F';
    case FIAT_IN = 'FIAT_IN';
    case FIAT_OUT = 'FIAT_OUT';
}

enum TTLUnits: string {
    case SEC = 'sec';
    case MIN = 'min';
    case HOUR = 'hour';
}

enum WidgetVersion: string {
    case REDIRECT = 'redirect';
    case NEW = 'new';
    case LEGACY = 'legacy';
}

enum DeepLinkType: string {
    case SBERPAY = 'sberpay';
    case TPAY = 'tpay';
    case ELQR = 'elqr';
    case INSTAPAY = 'instapay';
}

enum DeepLinkDevices: string {
    case ANDROID = 'android';
    case IOS = 'ios';
}

enum BankType: string {
    case BANK = 'bank';
    case EMONEY = 'emoney';
    case PROCESSING = 'processing';
}

enum BankPaymentSystems: string {
    case SBP = 'sbp';
    case SEPA = 'sepa';
    case M10 = 'm10';
}