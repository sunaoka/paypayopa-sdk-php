<?php

namespace PayPay\OpenPaymentAPI\Tests;

use PayPay\OpenPaymentAPI\Controller\ClientControllerException;

final class WalletTest extends TestBoilerplate
{

    /**
     * Wallet balance test
     *
     * @return void
     */
    public function testWalletBalance()
    {
        $this->InitCheck();
        $resp = $this->client->wallet->checkWalletBalance($this->config['uaid'], 1, 'JPY');
        $resultInfo = $resp['resultInfo'];
        $this->assertEquals('SUCCESS', $resultInfo['code']);
    }
    public function testWalletBalanceWProductType()
    {
        $resp = $this->client->wallet->checkWalletBalance($this->config['uaid'], 1, 'JPY', "VIRTUAL_BONUS_INVESTMENT");
        $resultInfo = $resp['resultInfo'];
        $this->assertEquals('SUCCESS', $resultInfo['code']);
    }
    public function testWalletBalanceWrongProduct()
    {
        try {
            $resp = $this->client->wallet->checkWalletBalance($this->config['uaid'], 1, 'JPY', "SnakeOil");
        } catch (ClientControllerException $e) {
            $this->assertStringContainsString("Invalid Direct Debit Product Type", $e->getMessage());
        }
    }
}
