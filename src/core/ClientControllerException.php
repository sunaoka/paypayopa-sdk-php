<?php

namespace PayPay\OpenPaymentAPI\Controller;

use Exception;

class ClientControllerException extends Exception
{
    /**
     * @var array{api_name: string, path: string, method: string}|false
     */
    private $apiInfo;

    /**
     * @var array{code: string, message: string, codeId: string}
     */
    private $resultInfo;

    /**
     * @var string|false
     */
    private $documentationUrl;

    /**
     * @param array{api_name: string, path: string, method: string}|false $apiInfo
     * @param array{code: string, message: string, codeId: string}|string $resultInfo
     * @param int $code
     * @param string|false $documentationUrl
     */
    public function __construct($apiInfo, $resultInfo, $code = 500, $documentationUrl = false)
    {
        $this->documentationUrl = $documentationUrl;
        $this->apiInfo = $apiInfo;
        if (gettype($resultInfo) === 'array') {
            parent::__construct($resultInfo['message'], $code);
            $this->resultInfo = $resultInfo;
        }
        if (gettype($resultInfo) === 'string') {
            // If string message error
            parent::__construct($resultInfo, $code);
        }
    }

    /**
     * @return string
     */
    public function getResolutionUrl()
    {
        if (!$this->documentationUrl || !$this->apiInfo) {
            return "https://github.com/paypay/paypayopa-sdk-php/issues/new/choose";
        }
        $resultInfo = $this->resultInfo;
        $documentationUrl = $this->documentationUrl;
        $code = $resultInfo["code"];
        $codeId = $resultInfo["codeId"];
        $apiName = $this->apiInfo["api_name"];
        return "{$documentationUrl}?api_name={$apiName}&code={$code}&code_id={$codeId}";
    }
}
