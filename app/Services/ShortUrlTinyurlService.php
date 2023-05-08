<?php

namespace App\Services;

use App\Services\Clients\TinyurlClient;
use App\Services\Parsers\TinyurlParser;

class ShortUrlTinyurlService implements ShortUrlService
{
    /**
     * @const string
     */
    protected const CREATE_URI = 'create';

    /**
     * @var TinyurlClient
     */
    protected $client;

    /**
     * @var TinyurlParser
     */
    protected $parser;

    /**
     * @param TinyurlClient $client
     * @param TinyurlParser $parser
     */
    public function __construct(TinyurlClient $client, TinyurlParser $parser)
    {
        $this->client = $client;
        $this->parser = $parser;
    }

    /**
     * @param array $data
     *
     * @return array|mixed
     */
    public function create(array $data)
    {
        $body = $this->parser->bodyForRequest($data);

        return $this->client->request('POST', self::CREATE_URI, $body);
    }
}
