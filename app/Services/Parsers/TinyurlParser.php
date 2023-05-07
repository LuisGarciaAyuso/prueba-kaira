<?php

namespace App\Services\Parsers;

class TinyurlParser
{
    public function bodyForRequest(array $data)
    {
        return [
            'url' => $data['url']
        ];
    }

    public function response(array $response)
    {
        return [
            'url' => $response['data']['tiny_url']
        ];
    }
}
