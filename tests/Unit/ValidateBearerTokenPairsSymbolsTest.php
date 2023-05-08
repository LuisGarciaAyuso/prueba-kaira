<?php

namespace Tests\Unit;

use App\Http\Middleware\ValidateBearerTokenPairsSymbols;
use Exception;
use Illuminate\Http\Request;
use Tests\TestCase;

class ValidateBearerTokenPairsSymbolsTest extends TestCase
{
    /**
     * @const string
     */
    protected const VALID_TOKEN = 'Bearer [[{}]]()';
    protected const INVALID_TOKEN = 'Bearer asdf';
    protected const EMPTY_TOKEN = 'Bearer ';

    /**
     * @test
     */
    public function test_handle_valid()
    {
        $request    = new Request();
        $request->headers->set('Authorization', self::VALID_TOKEN);
        $middleware = app(ValidateBearerTokenPairsSymbols::class);
        $middleware->handle($request, function () {
            $this->assertTrue(true);
        });
    }

    /**
     * @test
     */
    public function test_handle_invalid_token()
    {
        $this->expectException(Exception::class);

        $request    = new Request();
        $request->headers->set('Authorization', self::INVALID_TOKEN);
        $middleware = app(ValidateBearerTokenPairsSymbols::class);
        $middleware->handle($request, function () {
            //
        });
    }

    /**
     * @test
     */
    public function test_handle_valid_empty_token()
    {
        $request    = new Request();
        $request->headers->set('Authorization', self::EMPTY_TOKEN);
        $middleware = app(ValidateBearerTokenPairsSymbols::class);
        $middleware->handle($request, function () {
            $this->assertTrue(true);
        });
    }

    /**
     * @test
     */
    public function test_handle_no_authorization()
    {
        $this->expectException(Exception::class);

        $request    = new Request();
        $middleware = app(ValidateBearerTokenPairsSymbols::class);
        $middleware->handle($request, function () {
            //
        });
    }
}
