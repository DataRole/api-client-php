<?php

class ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to DataRole\API\Client::__construct() must be of the type array, null given
     */
    public function testClientRequiresArrayOfOptions()
    {
        new DataRole\API\Client(null);
    }

    public function testPermitReturnsModel()
    {
        $client = new DataRole\API\Client([], new GuzzleStub('./tests/stubs/property.json'));
        $client->lookupAddress('776+Buena+Vista+Ave+Alameda+CA+94501');

        $this->assertInstanceOf('DataRole\API\Models\Property', $client->getDataset());
    }
}

class GuzzleStub
{
    protected $uri;

    public function __construct($uri)
    {
        $this->stubUri = $uri;
    }

    public function get()
    {
        return $this;
    }

    public function post()
    {
        return $this;
    }

    public function getBody()
    {
        return $this;
    }

    public function getContents()
    {
        return file_get_contents($this->stubUri);
    }
}