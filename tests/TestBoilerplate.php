<?php

declare(strict_types=1);

namespace PayPay\OpenPaymentAPI\Tests;

use PHPUnit\Framework\TestCase;
use PayPay\OpenPaymentAPI\Client;

class TestBoilerplate extends TestCase
{
    /**
     * Open API Client
     *
     * @var Client
     */
    protected $client;
    /**
     * Buffer array to communicate data between tests
     *
     * @var Array
     */
    protected $data;
    /**
     * Test configuration
     *
     * @var Array
     */
    protected $config;
    public function __construct()
    {
        parent::__construct();
        $config = require('config.php');
        $this->client = new Client([
            'API_KEY' => $config['key'],
            'API_SECRET' => $config['secret'],
            'MERCHANT_ID' => $config['mid']
        ], 'test');
        $this->config = $config;
    }
    /**
     * Initialization check
     *
     * @return void
     */
    public function InitCheck()
    {
        $this->assertInstanceOf(Client::class, $this->client, 'Client initialized incorrectly.');
    }
}
