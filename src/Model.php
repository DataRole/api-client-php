<?php

namespace DataRole\API;

/**
 * Class Model
 * @package DataRole\API
 */
abstract class Model
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $mutable = [];

    /**
     * Force hydration of the entity with an array of attributes.
     *
     * @param array $attributes
     */
    public function hydrate(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        throw new \Exception("{$key} is not a valid property");
    }

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public function __set($key, $value)
    {
        if (!isset($this->attributes[$key])) {
            throw new  \Exception("{$key} is not a valid property");
        }

        if ($this->isMutable($key)) {
            $this->setAttribute($key, $value);
        } else {
            throw new \Exception("{$key} is not a mutable property");
        }
    }

    /**
     * Get the public attributes of a given array
     *
     * @param array $attributes
     * @return array
     */
    protected function getMutable(array $attributes)
    {
        if (count($this->mutable) > 0) {
            return array_intersect_key($attributes, array_flip($this->mutable));
        }

        return $this->attributes;
    }

    /**
     * Determine if the given attribute may be mass assigned
     *
     * @param string $key
     * @return bool
     */
    protected function isMutable($key)
    {
        if (in_array($key, $this->mutable)) {
            return true;
        }
    }

    /**
     * Hydrate mutable elements of the entity with an array of attributes.
     *
     * @param array $attributes
     */
    protected function push(array $attributes)
    {
        foreach ($this->getMutable($attributes) as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * Set attribute on object
     *
     * @param string $key
     * @param string $value
     */
    protected function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}