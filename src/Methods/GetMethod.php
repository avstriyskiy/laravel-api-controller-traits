<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Methods;

use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureExceptionClass;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureModel;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureRelationsForModel;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait GetMethod
{
    use ConfigureModel, ConfigureResource, ConfigureExceptionClass, ConfigureRelationsForModel;

    /**
     *   This method returns Resource class for Get method.
     *   You can redefine it in your Controller and in Get Method would be used different Resource class.
     *
     *   @return string|ResourceCollection
     */
    public function resourceClassForGet(): string
    {
        return $this->getResource();
    }
    
    /**
     *   This method returns array of additional information for your response.
     *   You can redefine it in your Controller.
     *
     *   @return string|ResourceCollection
     */
    public function additionalDataForGet(): array
    {
        return [];
    }
    
    /**
     *  Throws custom exception when you can't find Model. You can redefine it in your Controller.
     *  
     *  @return string
     */
    public function getModelNotFoundExceptionClassForGet(): string
    {
        return $this->getModelNotFoundExceptionClass();
    }

    /**
     *  Base Get method
     *
     *  @param int $id
     *  @return JsonResource|string
     */
    public function get(int $id)
    {
        try {
            if($this->getRelations()) {
                $data = $this->getModelClass()::with($this->getRelations())->findOrFail($id);
            } else {
                $data = $this->getModelClass()::findOrFail($id);
            }
        } catch (ModelNotFoundException $exception) {
            $modelNotFoundException = $this->getModelNotFoundExceptionClassForGet();
            throw new $modelNotFoundException();
        }
        return $this->resourceClassForGet()::make($data)->additional($this->additionalDataForGet());
    }
}
