<?php

namespace DataRole\API\Meta;

use ReflectionClass;
use DataRole\API\Model;

/**
 * Class Base
 * @package DataRole\API\Meta
 */
class Base
{

    /**
     * The ReflectionClass instance
     *
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * The class to inspect
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->reflection = new ReflectionClass($model);
    }

    /**
     * Create new Name instance
     *
     * @return Name
     */
    protected function getNameInstance()
    {
        return new Name($this->reflection->getShortName());
    }

    /**
     * Convert the name to lowercase
     *
     * @return Name
     */
    public function lowercase()
    {
        return $this->getNameInstance()->lowercase();
    }

    /**
     * Convert the name to plural
     *
     * @return Name
     */
    public function plural()
    {
        return $this->getNameInstance()->plural();
    }

    /**
     * Convert the name to singular
     *
     * @return Name
     */
    public function singular()
    {
        return $this->getNameInstance()->singular();
    }

    /**
     * Convert the name to uppercase
     *
     * @return Name
     */
    public function uppercase()
    {
        return $this->getNameInstance()->uppercase();
    }
}