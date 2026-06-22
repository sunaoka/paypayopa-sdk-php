<?php

namespace PayPay\OpenPaymentAPI\Tests;

final class UserTest extends TestBoilerplate
{
    /**
     * Default user authorization id for testing
     *
     * @var string
     */
    private $userAuthorizationId = "0ef0948e-314c-42e1-9312-03ce446fa5ef";

    public function __construct()
    {
        parent::__construct();
        $config = require('config.php');
        $this->userAuthorizationId = $config['uaid'];
    }


    /**
     * test for getUserAuthorizationStatus
     *
     * @return void
     */
    public function testGetUserAuthorizationStatus()
    {
        $this->InitCheck();
        $resp = $this->client->user->getUserAuthorizationStatus($this->userAuthorizationId);
        var_dump(json_encode($resp));
        $resultInfo = $resp['resultInfo'];
        $this->assertEquals('SUCCESS', $resultInfo['code']);
    }
    /**
     * test for GetMaskedUserProfile
     *
     * @return void
     */
    public function testGetMaskedUserProfile()
    {
        $this->InitCheck();
        $resp = $this->client->user->getMaskedUserProfile($this->userAuthorizationId);
        var_dump(json_encode($resp));
        $resultInfo = $resp['resultInfo'];
        $this->assertEquals('SUCCESS', $resultInfo['code']);
    }
    /**
     * test for Unlink
     *
     * @return void
     */
    public function testUnlink()
    {
        $resp = $this->client->user->unlinkUser($this->userAuthorizationId);
        var_dump(json_encode($resp));
        $resultInfo = $resp['resultInfo'];
        $this->assertEquals('REQUEST_ACCEPTED', $resultInfo['code']);
    }
}
