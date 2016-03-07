<?php

namespace DataRole\API\Models;

use DataRole\API\Model;

/**
 * Class Property
 * @package DataRole\API\Models
 */
class Property extends Model
{
    /**
     * @var array
     */
    protected $mutable = [];

    /**
     * @param array $attributes
     */
    public function hydrate(array $attributes)
    {
        $this->attributes = isset($attributes['data']) ? $attributes['data']['property'] : @$attributes['property'];
    }
}