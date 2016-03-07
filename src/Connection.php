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
     * @var array
     */
    protected $response = [];

    /**
     * @var GuzzleHttp\Client
     */
    protected $http;

    /**
     * @var array
     */
    protected $meta;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param object $di Guzzle Dependancy Injection
     * @param array $options
     */
    public function __construct($options, $di = null)
    {
        $this->options = $options ?: ["authorization" => null, "instance" => "default", "version" => 'v1'];
        $this->http    = $di ?: $this->http();
    }

    /**
     * Fetches a single record via get
     *
     * @param Model $model
     * @param integer $id
     * @return string
     */
    public function get($model, $id)
    {
        $payload = json_decode(
            $this
                ->http
                ->get("{$model->base()->singular()->lowercase()}/{$id}")
                ->getBody()
                ->getContents(),
            true
        );

        $this->meta     = $payload['meta'];
        $this->response = $payload['response']; 
        $normalizer     = new Normalizer($model);

        return $normalizer->model($payload);
    }

    /**
     * @param Model $model
     * @param array $params
     * @return mixed
     */
    public function post($model, $params)
    {
        $payload = json_decode(
            $this
                ->http
                ->post($model->base()->plural()->lowercase(), ['form_params' => $params])
                ->getBody()
                ->getContents(),
            true
        );

        $this->meta     = $payload['meta'];
        $this->response = $payload['response'];
        $normalizer     = new Normalizer($model);

        return $normalizer->collection($payload);
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
                    'base_uri' => self::BASE_URL."{$this->options['instance']}/{$this->options['version']}/",
                    'headers'  => [
                        'Accept'                   => 'application/json',
                        'Content-Type'             => 'application/json',
                        'X-DataRole-Authorization' => $this->options['authorization'],
                    ],
                ]
            );
        }

        return $this->http;
    }
}