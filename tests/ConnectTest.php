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

    public function testGetReturnsASingleModel()
    {
        $model      = new Models\Permit();
        $connection = new Connection(null, new GuzzleStub('./tests/stubs/permit.json'));
        $response   = $connection->get($model, 1);

        $this->assertInstanceOf('DataRole\API\Model', $response);
    }

    public function testPostReturnsACollection()
    {
        $model      = new Models\Permit();
        $connection = new Connection(null, new GuzzleStub('./tests/stubs/permits.json'));
        $response   = $connection->post($model, []);

        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
    }
}