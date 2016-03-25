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
     * @var array
     */
    protected $response = [];

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @var array
     */
    protected $pagination = [];

    /**
     * @param object $di Guzzle Dependancy Injection
     * @param array $options
     */
    public function __construct($options, $di = null)
    {
        $this->options = $options ?: ["authorization" => null, "version" => 'v1'];
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
    public function post($model, $params, $limit, $page)
    {
        $payload = json_decode(
            $this
                ->http
                ->post($model->base()->plural()->lowercase()."/{$limit}/{$page}", ['form_params' => $params])
                ->getBody()
                ->getContents(),
            true
        );

        $this->meta       = $payload['meta'];
        $this->response   = $payload['response'];
        $this->pagination = $payload['pagination'];
        $normalizer       = new Normalizer($model);

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
                    'base_uri' => self::BASE_URL."building/{$this->options['version']}/",
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