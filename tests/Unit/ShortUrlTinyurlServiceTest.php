<?php

namespace Tests\Unit;

use App\Services\ShortUrlTinyurlService;
use Exception;
use Tests\TestCase;

class ShortUrlTinyurlServiceTest extends TestCase
{
    /**
     * @const string
     */
    protected const VALID_URL = 'https://longurl-lorem-ipsum-dolor-sit-amet';
    protected const INVALID_URL = 'asdf';

    /**
     * @test
     */
    public function test_create_valid()
    {
        $data     = ['url' => self::VALID_URL];
        $service  = app(ShortUrlTinyurlService::class);
        $response = $service->create($data);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('url', $response);
    }

    /**
     * @test
     */
    public function test_create_invalid_url()
    {
        $data     = ['url' => self::INVALID_URL];
        $service  = app(ShortUrlTinyurlService::class);
        $response = $service->create($data);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('success', $response);
        $this->assertFalse($response['success']);
    }

    /**
     * @test
     */
    public function test_create_invalid_data()
    {
        $this->expectException(Exception::class);

        $data     = [];
        $service  = app(ShortUrlTinyurlService::class);
        $service->create($data);
    }
}
