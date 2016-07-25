<?php

namespace DataRole\API;

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
     * @var Model
     */
    private $dataset;

    /**
     * @param array $options
     * @param object $di Guzzle Dependency Injection
     */
    public function __construct(array $options, $di = null)
    {
        $this->connection = new Connection($options, $di);
    }

    /**
     * @return Model
     */
    public function getDataset()
    {
        return $this->dataset;
    }

    /**
     * @param string $address
     * @return Client $this
     */
    public function lookupAddress($address)
    {
        $this->dataset = $this->connection->get($address);

        return $this;
    }

    /**
     * prints a preview of the registered dataset
     *
     * @codeCoverageIgnore
     */
    public function printPreview()
    {
        ini_set('xdebug.var_display_max_depth', -1);
        ini_set('xdebug.var_display_max_children', -1);
        ini_set('xdebug.var_display_max_data', -1);

        var_dump($this->dataset);
    }
}