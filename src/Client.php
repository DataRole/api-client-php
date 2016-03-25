<?php

namespace DataRole\API;

use Illuminate\Support\Collection;

use DataRole\API\Models;

/**
 * Class Client
 * @package DataRole\API
 */
class Client
{
    /**
     * The HTTP Connection
     *
     * @var Connection
     */
    private $connection;

    /**
     * @var Model|Collection
     */
    private $dataset;

    /**
     * @param array $options
     * @param object $di Guzzle Dependancy Injection
     */
    public function __construct(array $options, $di = null)
    {
        $this->connection = new Connection($options, $di);
    }

    /**
     * @return Model|Collection
     */
    public function dataset()
    {
        return $this->dataset;
    }

    /**
     * @param int|array $params
     * @param int $limit
     * @param int $page
     * @return Client $this
     */
    public function permit($params, $limit = 25, $page = 0)
    {
        $model         = new Models\Permit();
        $this->dataset = is_array($params)
            ? $this->connection->post($model, $params, $limit, $page) : $this->connection->get($model, $params);

        return $this;
    }

    /**
     * @param int|array $params
     * @param int $limit
     * @param int $page
     * @return Client $this
     */
    public function property($params, $limit = 25, $page = 0)
    {
        $model         = new Models\Property();
        $this->dataset = is_array($params)
            ? $this->connection->post($model, $params, $limit, $page) : $this->connection->get($model, $params);

        return $this;
    }

    /**
     * @param int|array $params
     * @param int $limit
     * @param int $page
     * @return Client $this
     */
    public function professional($params, $limit = 25, $page = 0)
    {
        $model         = new Models\Professional();
        $this->dataset = is_array($params)
            ? $this->connection->post($model, $params, $limit, $page) : $this->connection->get($model, $params);

        return $this;
    }

    /**
     * prints a preview or the registered dataset
     *
     * @codeCoverageIgnore
     */
    public function preview()
    {
        ini_set('xdebug.var_display_max_depth', -1);
        ini_set('xdebug.var_display_max_children', -1);
        ini_set('xdebug.var_display_max_data', -1);

        var_dump($this->dataset);
    }
}