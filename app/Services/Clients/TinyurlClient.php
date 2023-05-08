<?php

namespace App\Services\Clients;

use App\Services\Parsers\TinyurlParser;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TinyurlClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var TinyurlParser
     */
    protected $parser;

    /**
     * @param Client        $client
     * @param TinyurlParser $parser
     */
    public function __construct(Client $client, TinyurlParser $parser)
    {
        $this->client = $client;
        $this->parser = $parser;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $body
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $uri, array $body)
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
            logger()->error('Error code ' . $exception->getResponse()->getStatusCode() . '. Message: ' .
                $exception->getResponse()->getReasonPhrase());

            return ['success' => false];
        } catch (Exception $exception) {
            logger()->error('Error with message: ' . $exception->getMessage());

            return ['success' => false];
        }
    }
}
