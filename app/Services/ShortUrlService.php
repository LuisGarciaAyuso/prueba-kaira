<?php

namespace App\Services;

use GuzzleHttp\Client;

interface ShortUrlService
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);
}
