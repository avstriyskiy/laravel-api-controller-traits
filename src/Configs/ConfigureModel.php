<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

use Spatie\QueryBuilder\QueryBuilder;

/**
 *  Trait for base controller model configuration.
 */
trait ConfigureModel
{
    /**
     *  Returns model class as ::class string. Must be redefined in controller.
     *
     *  @return string|Model
     */
    public abstract function getModelClass(): string;

    /**
     *  Returns Spatie\QueryBuilder to be used for filtration and pagination. 
     *
     *  @return QueryBuilder
     */
    public function getCustomBuilder(): QueryBuilder
    {
        return QueryBuilder::for($this->getModelClass());
}
}
