<?php

use DataRole\API\Connection;
use DataRole\API\Models;

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Connection
     */
    protected $connection;

    public function setup()
    {
        $this->connection = new Connection(null);
    }

    public function testGetGuzzleClient()
    {
        $this->assertInstanceOf('GuzzleHttp\Client', $this->connection->http());
    }

    public function testReUseOfExistingGuzzleClient()
    {
        $guzzle1 = $this->connection->http();
        $guzzle2 = $this->connection->http();

        $this->assertSame($guzzle1, $guzzle2);
    }

    public function testGetReturnsAModel()
    {
        $model      = new Models\Property();
        $connection = new Connection(null, new GuzzleStub('./tests/stubs/property.json'));
        $response   = $connection->get('776+Buena+Vista+Ave+Alameda+CA+94501');

        $this->assertInstanceOf('DataRole\API\Model', $response);
    }
}