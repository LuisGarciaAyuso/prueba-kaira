<?php

namespace App\Services;

use App\Services\Parsers\TinyurlParser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Log;

class ShortUrlTinyurlService implements ShortUrlService
{
    /**
     * @const string
     */
    protected const CREATE_URI = 'create';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var TinyurlParser
     */
    protected $parser;

    /**
     * @param Client $client
     * @param TinyurlParser $parser
     */
    public function __construct(Client $client, TinyurlParser $parser)
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

        return $this->request('POST', self::CREATE_URI, $body);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $body
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $uri, array $body)
    {
        $url     = config('services.tinyurl.url') . DIRECTORY_SEPARATOR . $uri;
        $options = [
            'headers'     => [
                'Authorization' => 'Bearer ' . config('services.tinyurl.token'),
                'Accept'        => 'application/json',
            ],
            'form_params' => $body
        ];

        try {
            $response     = $this->client->request($method, $url, $options);
            $responseBody = json_decode($response->getBody()->getContents(), true);

            return $this->parser->response($responseBody);
        } catch (ClientException $exception) {
            Log::error('Error code ' . $exception->getResponse()->getStatusCode() . '. Message: ' .
                $exception->getResponse()->getReasonPhrase());

            return ['success' => false];
        }
    }
}
