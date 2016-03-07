<?php

use Mockery as m;
use DataRole\API\Model;
use DataRole\API\Connection;
use DataRole\API\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var Normalizer
     */
    private $normalizer;

    public function setUp()
    {
        $this->model      = new NormalizeModelStub();
        $this->normalizer = new Normalizer($this->model);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to DataRole\API\Normalizer::__construct() must be an instance of DataRole\API\Model, null given
     */
    public function testNormalizerShouldRequireModel()
    {
        new Normalizer(null);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to DataRole\API\Normalizer::collection() must be of the type array, null given
     */
    public function testCollectionShouldRequireArrayOfAttributes()
    {
        $this->normalizer->collection(null);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to DataRole\API\Normalizer::model() must be of the type array, null given
     */
    public function testModelShouldRequireArrayOfAttributes()
    {
        $this->normalizer->model(null);
    }

    public function testCollectionReturnsACollection()
    {
        $this->assertInstanceOf(
            'Illuminate\Support\Collection',
            $this->normalizer->collection(
                ['data' => [0 => ['permit' => []]]]
            )
        );
    }

    public function testModelReturnsAModel()
    {
        $this->assertInstanceOf('DataRole\API\Model', $this->normalizer->model(['data' => ['permit' => []]]));
    }
}

class NormalizeModelStub extends Model
{
    public function base()
    {
        return new BaseStub($this);
    }
}

class BaseStub
{
    public function singular()
    {
        return 'permit';
    }
}