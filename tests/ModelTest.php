<?php

use DataRole\API\Traits;

class ModelTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ModelStub
     */
    protected $model;

    public function setUp()
    {
        $this->model = new ModelStub();
        $this->model->hydrate(['immutable' => 'cantTouchThis', 'key' => 'values']);
    }

    public function testHydratingAnArrayOfAttributes()
    {
        $this->assertEquals('values', $this->model->key);
    }

    public function testSettingAProperty()
    {
        $this->model->key = 'value';
        $this->assertEquals('value', $this->model->key);
    }

    /**
     * @expectedException Exception
     */
    public function testSettingNonExistantPropertyFails()
    {
        $this->model->nonExistantPropery = 'value';
    }

    /**
     * @expectedException Exception
     */
    public function testSettingImmutablePropertyFails()
    {
        $this->model->immutable = 'value';
    }

    /**
     * @expectedException Exception
     */
    public function testPushingImmutableProperties()
    {
        $immutableModel = new ImmutableModelStub();
        $immutableModel->key;
    }

    /**
     * @expectedException Exception
     */
    public function testGettingNonExistantPropertyFails()
    {
        $value = $this->model->invalidAtrribute;
    }

    public function testGetPluralEntityName()
    {
        $this->assertEquals('modelstubs', $this->model->base()->lowercase()->plural());
        $this->assertEquals('MODELSTUBS', $this->model->base()->uppercase()->plural());
        $this->assertEquals('ModelStubs', $this->model->base()->plural());
    }

    public function testGetLowercaseSingularEntityName()
    {
        $this->assertEquals('modelstub', $this->model->base()->lowercase()->singular());
        $this->assertEquals('MODELSTUB', $this->model->base()->uppercase()->singular());
        $this->assertEquals('ModelStub', $this->model->base()->singular());
    }

    /*
    public function testValidatingFailsWithMissingRequiredField()
    {
        $this->assertFalse($this->model->validate());
    }

    public function testValidatingPassesWithRequiredField()
    {
        $this->model->updatedAt = 'date';
        $this->assertTrue($this->model->validate());
    }
    */
}

class ModelStub extends DataRole\API\Model
{
    /**
     * @var array
     */
    protected $mutable = ['key'];

    public function __construct()
    {
        $this->push(['key' => 'test']);
    }
}

class ImmutableModelStub extends DataRole\API\Model
{
    /**
     * @var array
     */
    protected $attributes = ['immutable' => 'cantTouchThis'];

    /**
     * @var array
     */
    protected $mutable = [];

    public function __construct()
    {
        $this->push(['key' => 'test']);
    }
}