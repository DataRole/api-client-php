<?php

namespace DataRole\API\Meta;

use Illuminate\Support\Pluralizer;

/**
 * Class Name
 * @package DataRole\API\Meta
 */
class Name
{

    /**
     * The name
     *
     * @var string
     */
    protected $name;

    /**
     * Create a new Name instance
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Convert the name to lowercase
     *
     * @return Name
     */
    public function lowercase()
    {
        return new Name(strtolower($this->name));
    }

    /**
     * Convert the name to plural
     *
     * @return Name
     */
    public function plural()
    {
        return new Name(Pluralizer::plural($this->name));
    }

    /**
     * Convert the name to singular
     *
     * @return Name
     */
    public function singular()
    {
        return new Name(Pluralizer::singular($this->name));
    }

    /**
     * Convert the name to uppercase
     *
     * @return Name
     */
    public function uppercase()
    {
        return new Name(strtoupper($this->name));
    }

    /**
     * Return the name as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}