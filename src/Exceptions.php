<?php
namespace PaymentsGate\Exceptions;

use Exception;

class ApiClientException extends Exception {
    public array $data;
    public function __construct(string $message, array $data = [], int $code = 0) {
        parent::__construct($message, $code);
        $this->data = $data;
    }
}

class ErrorConfigFileNotParsed extends ApiClientException {}
class ErrorConfigMismatch extends ApiClientException {}
class ErrorConfigEndpointInvalidUrl extends ApiClientException {}
class ErrorRequestProcessed extends ApiClientException {}
class ErrorUnauthorizedRequest extends ApiClientException {}
class ErrorForbiddenRequest extends ApiClientException {}