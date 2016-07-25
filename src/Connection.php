<?php

namespace DataRole\API;

use GuzzleHttp;
use DataRole\API\Models;

/**
 * Class Connection
 * @package DataRole\API
 */
class Connection
{
    const BASE_URL = "https://api.datarole.com/";

    /**
     * @var GuzzleHttp\Client
     */
    protected $http;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param object $di Guzzle Dependancy Injection
     * @param array $options
     */
    public function __construct($options, $di = null)
    {
        $this->options = $options ?: ["account" => null, "secret" => null, "version" => 'v2'];
        $this->http    = $di ?: $this->http();
    }

    /**
     * Fetches a single record via get
     *
     * @param Model $model
     * @param string $address
     * @return string
     */
    public function get($address)
    {
        $payload = json_decode(
            $this
                ->http
                ->get("address/{$address}")
                ->getBody()
                ->getContents(),
            true
        );

        $model = new Models\Property();
        $model->hydrate($payload);

        return $model;
    }

    /**
     * Returns an instance of the http client
     *
     * @return GuzzleHttp\Client
     */
    public function http()
    {
        if ($this->http) {
            return $this->http;
        } else {
            $this->http = new GuzzleHttp\Client(
                [
                    'auth'     => [$this->options['account'], $this->options['secret']],
                    'base_uri' => self::BASE_URL."building/{$this->options['version']}/",
                    'headers'  => [
                        'Accept'       => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]
            );
        }

        return $this->http;
    }
}