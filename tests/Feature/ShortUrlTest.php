<?php

namespace Tests\Feature;

use App\Models\Url;
use Tests\TestCase;

class ShortUrlTest extends TestCase
{
    protected const VALID_URL = 'https://longurl-lorem-ipsum-dolor-sit-amet';
    protected const INVALID_URL = 'asdf';
    protected const VALID_TOKEN = 'Bearer {}[][[]]';
    protected const INVALID_TOKEN = 'Bearer {[[[)]';

    /**
     * @test
     */
    public function short_url_valid()
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

        $response->assertStatus(200)->assertJsonStructure(['url']);

        $responseContent = json_decode($response->getContent());
        $this->assertDatabaseHas(Url::class, [
            'url'       => self::VALID_URL,
            'short_url' => $responseContent->url
        ]);
    }

    /**
     * @test
     */
    public function short_url_invalid_token()
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
    public function short_url_invalid_url()
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
}
