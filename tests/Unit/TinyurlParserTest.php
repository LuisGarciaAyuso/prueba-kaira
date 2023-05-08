<?php

namespace Tests\Unit;

use App\Services\Parsers\TinyurlParser;
use Tests\TestCase;

class TinyurlParserTest extends TestCase
{
    /**
     * @test
     */
    public function test_body_for_request_valid()
    {
        $data     = ['url' => 'https://google.es'];
        $parser   = app(TinyurlParser::class);
        $response = $parser->bodyForRequest($data);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('url', $response);
    }

    /**
     * @test
     */
    public function test_body_for_request_invalid()
    {
        $this->expectException(\Exception::class);

        $data     = [];
        $parser   = app(TinyurlParser::class);
        $parser->bodyForRequest($data);
    }

    /**
     * @test
     */
    public function test_response_valid()
    {
        $data     = [
            'data' => [
                'tiny_url' => 'https://google.es'
            ]
        ];
        $parser   = app(TinyurlParser::class);
        $response = $parser->response($data);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('url', $response);
    }

    /**
     * @test
     */
    public function test_response_invalid()
    {
        $this->expectException(\Exception::class);

        $data     = [];
        $parser   = app(TinyurlParser::class);
        $parser->response($data);
    }
}
