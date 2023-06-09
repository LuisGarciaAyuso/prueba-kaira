<?php

namespace Tests\Feature;

use App\Models\Url;
use App\Services\ShortUrlService;
use Tests\TestCase;

class ShortUrlTest extends TestCase
{
    /**
     * @const string
     */
    protected const VALID_URL = 'https://longurl-lorem-ipsum-dolor-sit-amet';
    protected const INVALID_URL = 'asdf';
    protected const VALID_TOKEN = 'Bearer {}[][[]]';
    protected const INVALID_TOKEN = 'Bearer {[[[)]';
    protected const EMPTY_TOKEN = 'Bearer ';

    /**
     * @test
     */
    public function test_short_url_valid()
    {
        $response = $this->post(
            '/api/v1/short-urls',
            [
                'url' => self::VALID_URL
            ],
            [
                'Authorization' => self::VALID_TOKEN
            ]
        );

        $this->assertSuccessShortUrl($response);
    }

    /**
     * @test
     */
    public function test_short_url_empty_token()
    {
        $response = $this->post(
            '/api/v1/short-urls',
            [
                'url' => self::VALID_URL
            ],
            [
                'Authorization' => self::EMPTY_TOKEN
            ]
        );

        $this->assertSuccessShortUrl($response);
    }

    /**
     * @test
     */
    public function test_short_url_invalid_token()
    {
        $response = $this->post(
            '/api/v1/short-urls',
            [
                'url' => self::VALID_URL
            ],
            [
                'Authorization' => self::INVALID_TOKEN
            ]
        );

        $response->assertStatus(500);
    }

    /**
     * @test
     */
    public function test_short_url_invalid_url()
    {
        $response = $this->post(
            '/api/v1/short-urls',
            [
                'url' => self::INVALID_URL
            ],
            [
                'Authorization' => self::VALID_TOKEN
            ]
        );

        $response->assertStatus(200)->assertJson(['success' => false]);
    }

    /**
     * @param $response
     *
     * @return void
     */
    protected function assertSuccessShortUrl($response)
    {
        $response->assertStatus(200)->assertJsonStructure(['url']);
        $responseContent = json_decode($response->getContent());
        $shortUrlService = $this->app->make(ShortUrlService::class);

        $this->assertDatabaseHas(Url::class, [
            'url'               => self::VALID_URL,
            'short_url'         => $responseContent->url,
            'shortening_method' => $shortUrlService::NAME ?? null
        ]);
    }
}
