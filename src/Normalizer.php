<?php

namespace DataRole\API;

use Illuminate\Support\Collection;

/**
 * Class Normalizer
 * @package DataRole\API
 */
class Normalizer
{
    /**
     * The Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * The options array
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new Normalizer instance
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Normalize a collection of models
     *
     * @param array $attributes
     * @return Collection
     */
    public function collection(array $attributes)
    {
        return $this->normalizeCollection($attributes);
    }

    /**
     * Normalize a single model
     *
     * @param array $attributes
     * @return Model
     */
    public function model(array $attributes)
    {
        return $this->normalizeModel($this->model->base()->singular(), $attributes);
    }

    /**
     * Normalize a collection
     *
     * @param array $attributes
     * @return Collection
     */
    private function normalizeCollection(array $attributes)
    {
        $collection = new Collection;

        foreach ($attributes['data'] as $entity) {
            $collection[] = $this->normalizeModel($this->model->base()->singular(), $entity);
        }

        return $collection;
    }

    /**
     * Normalize a single model
     *
     * @param array $attributes
     * @return Model
     */
    private function normalizeModel($name, array $attributes)
    {
        $class = "DataRole\\API\\Models\\".ucfirst($name);
        $model = new $class();

        /**
         * @var Model $model
         */
        $model->hydrate($attributes);

        return $model;
    }
}