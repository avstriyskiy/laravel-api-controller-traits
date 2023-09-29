<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Methods;

use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureExceptionClass;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureModel;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureRequest;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait UpdateMethod
{
    use ConfigureModel, ConfigureResource, ConfigureRequest, ConfigureExceptionClass;

    /**
    *   This method returns Resource class for Update Method.
    *   You can redefine it in your Controller and in Update Method would be used different Resource class.
    *
    *   @return string|JsonResource
    */
    public function resourceClassForUpdate(): string
    {
        return $this->getResource();
    }
    
    /**
    *   This method returns array of additional information for your response.
    *   You can redefine it in your Controller.
    *
    *   @return array
    */
    public function additionalDataForUpdate(): array
    {
        return [];
    }

    /**
    *  Throws custom exception when you can't find Model. You can redefine it in your Controller.
    *  
    *  @return string
    */
    public function getModelNotFoundExceptionForUpdate(): string
    {
        return $this->getModelNotFoundExceptionClass();
    }

    /**
     *  Create method
     *
     *  @return JsonResource|string
     */
    public function update(int $id)
    {
        $data = $this->getValidatedData("update");

        try {
            $model = $this->getModelClass()::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            $modelNotFoundException = $this->getModelNotFoundExceptionForUpdate();
            throw new $modelNotFoundException();
        }

        $model->update($data);

        return $this->resourceClassForUpdate()::make($model)->additional($this->additionalDataForUpdate());
    }

        
}
