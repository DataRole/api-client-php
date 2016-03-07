<?php

namespace DataRole\API\Models;

use DataRole\API\Model;

/**
 * Class Professional
 * @package DataRole\API\Models
 */
class Professional extends Model
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
        $this->attributes = isset($attributes['data']) ? $attributes['data']['professional'] : @$attributes['professional'];
    }
}