<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class ValidateBearerToken
{
    /**
     * @param Request $request
     * @param         $next
     *
     * @return mixed
     */
    public function handle(Request $request, $next)
    {
        if ($this->bearerTokenIsValid($request)) {
            return $next($request);
        }

        throw new UnauthorizedException('Authorization not valid.');
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function bearerTokenIsValid(Request $request)
    {
        $bearerToken = $this->getBearerToken($request);

        return isset($bearerToken);
    }

    /**
     * @param Request $request
     *
     * @return string|null
     */
    protected function getBearerToken(Request $request) {
        if ($authorization = $request->header('Authorization')) {
            if (str_starts_with($authorization, 'Bearer ')) {
                return str_replace('Bearer ', '', $authorization);
            }
        }

        return null;
    }
}
