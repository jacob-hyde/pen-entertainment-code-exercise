<?php

namespace Tests;

use PHPUnit\Framework\TestCase as TestCaseBase;
use GuzzleHttp\Client;

class TestCase extends TestCaseBase
{
    /**
     * Guzzle HTTP client instance.
     *
     * @var Client|null
     */
    protected ?Client $http;

    /**
     * Set up the test.
     */
    protected function setUp(): void
    {
        $this->http = new Client(['base_uri' => 'http://localhost']);
    }

    /**
     * Tear down the test.
     */
    protected function tearDown(): void
    {
        $this->http = null;
    }
}