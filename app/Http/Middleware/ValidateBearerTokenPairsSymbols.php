<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class ValidateBearerTokenPairsSymbols extends ValidateBearerTokenPairs
{
    /**
     * @const string[]
     */
    protected const PAIRS = [
        '(' => ')',
        '[' => ']',
        '{' => '}'
    ];

    /**
     * @return array
     */
    protected function getPairs(): array
    {
        return self::PAIRS;
    }
}
