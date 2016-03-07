<?php

namespace DataRole\API\Traits;

use Sirius\Validation\Validator;

/**
 * Class Validation
 * @package DataRole\API\Traits
 */
trait Validation
{
    /**
     * The validation errors
     *
     * @var array
     */
    protected $errors;

    /**
     * Return the validation errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Validate the model's properties
     *
     * @return bool
     */
    public function validate()
    {
        $validator = new Validator;
        $validator->add($this->validation);

        if ($validator->validate($this->attributes)) {
            return true;
        }

        $this->errors = $validator->getMessages();

        return false;
    }
}