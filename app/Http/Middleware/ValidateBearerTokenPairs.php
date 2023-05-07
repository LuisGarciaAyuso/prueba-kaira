<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

abstract class ValidateBearerTokenPairs extends ValidateBearerToken
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function bearerTokenIsValid(Request $request)
    {
        $bearerToken      = $this->getBearerToken($request);
        $valid            = true;
        $bearerTokenChars = str_split($bearerToken);
        $openChars        = [];
        foreach ($bearerTokenChars as $char) {
            if (!$this->validateChar($char)) {
                $valid = false;
                break;
            }
            if (empty($openChars) && !$this->isOpenChar($char)) {
                $valid = false;
                break;
            }
            if ($this->isOpenChar($char)) {
                $openChars[] = $char;
            } else {
                if ($char !== $this->getPairs()[last($openChars)]) {
                    $valid = false;
                    break;
                }
                array_pop($openChars);
            }
        }
        if (!empty($openChars)) {
            $valid = false;
        }

        return $valid;
    }

    /**
     * @return array
     */
    abstract protected function getPairs(): array;

    /**
     * @param string $char
     *
     * @return bool
     */
    protected function validateChar(string $char)
    {
        return $this->isOpenChar($char) || $this->isCloseChar($char);
    }

    /**
     * @param string $char
     *
     * @return bool
     */
    protected function isOpenChar(string $char)
    {
        return in_array($char, array_keys($this->getPairs()));
    }

    /**
     * @param string $char
     *
     * @return bool
     */
    protected function isCloseChar(string $char)
    {
        return in_array($char, array_values($this->getPairs()));
    }
}
