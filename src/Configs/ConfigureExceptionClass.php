<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

use Illuminate\Database\Eloquent\ModelNotFoundException as IlluminateModelNotFoundException;

trait ConfigureExceptionClass
{

    /**
     * Exceptions for cases when model is not found
     * You can redefine this for each method
     *
     * @return string | ModelNotFoundException
     *
     */
    public function getModelNotFoundExceptionClass(): string
    {
        return  IlluminateModelNotFoundException::class;
    }

}
