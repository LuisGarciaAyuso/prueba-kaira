<?php

namespace App\Services\Parsers;

class TinyurlParser
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function bodyForRequest(array $data)
    {
        return [
            'url' => $data['url']
        ];
    }

    /**
     * @param array $response
     *
     * @return array
     */
    public function response(array $response)
    {
        return [
            'url' => $response['data']['tiny_url']
        ];
    }
}
