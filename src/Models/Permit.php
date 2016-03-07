<?php

namespace DataRole\API\Models;

use DataRole\API\Model;

/**
 * Class Permit
 * @package DataRole\API\Models
 */
class Permit extends Model
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
        $this->attributes = isset($attributes['data']) ? $attributes['data']['permit'] : @$attributes['permit'];
    }
}