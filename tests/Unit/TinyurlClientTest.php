<?php

namespace Tests\Unit;

use App\Services\Clients\TinyurlClient;
use Tests\TestCase;

class TinyurlClientTest extends TestCase
{
    /**
     * @const string
     */
    protected const VALID_URI = 'create';
    protected const INVALID_URI = 'asdf';
    protected const VALID_URL = 'https://longurl-lorem-ipsum-dolor-sit-amet';
    protected const INVALID_URL = 'asdf';

    /**
     * @test
     */
    public function test_request_valid()
    {
        $data     = ['url' => self::VALID_URL];
        $client   = app(TinyurlClient::class);
        $response = $client->request(
            'POST',
            self::VALID_URI,
            $data
        );

        $this->assertIsArray($response);
        $this->assertArrayHasKey('url', $response);
    }

    /**
     * @test
     */
    public function test_request_invalid_method()
    {
        $data     = ['url' => self::VALID_URL];
        $client   = app(TinyurlClient::class);
        $response = $client->request(
            'DELETE',
            self::VALID_URI,
            $data
        );

        $this->assertIsArray($response);
        $this->assertArrayHasKey('success', $response);
        $this->assertFalse($response['success']);
    }

    /**
     * @test
     */
    public function test_request_invalid_uri()
    {
        $data     = ['url' => self::VALID_URL];
        $client   = app(TinyurlClient::class);
        $response = $client->request(
            'POST',
            self::INVALID_URI,
            $data
        );

        $this->assertIsArray($response);
        $this->assertArrayHasKey('success', $response);
        $this->assertFalse($response['success']);
    }

    /**
     * @test
     */
    public function test_request_invalid_url()
    {
        $data     = ['url' => self::INVALID_URL];
        $client   = app(TinyurlClient::class);
        $response = $client->request(
            'POST',
            self::VALID_URI,
            $data
        );

        $this->assertIsArray($response);
        $this->assertArrayHasKey('success', $response);
        $this->assertFalse($response['success']);
    }

    /**
     * @test
     */
    public function test_request_invalid_data()
    {
        $data     = [];
        $client   = app(TinyurlClient::class);
        $response = $client->request(
            'POST',
            self::VALID_URI,
            $data
        );

        $this->assertIsArray($response);
        $this->assertArrayHasKey('success', $response);
        $this->assertFalse($response['success']);
    }
}
