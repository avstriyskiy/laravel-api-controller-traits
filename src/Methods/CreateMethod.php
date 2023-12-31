<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Methods;

use Illuminate\Http\Resources\Json\JsonResource;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureResource;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureModel;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureRequest;

trait CreateMethod
{
    use ConfigureModel, ConfigureResource, ConfigureRequest;

    /**
    *   This method returns Resource class for create method.
    *   You can redefine it in your Controller and in Create Method would be used different Resource class.
    *
    *   @return string|JsonResource
    */
    public function resourceClassForCreate(): string
    {
        return $this->getResource();
    }
    
    /**
    *   This method returns array of additional information for your response.
    *   You can redefine it in your Controller.
    *
    *   @return array
    */
    public function additionalDataForCreate(): array
    {
        return [];
    }

    /**
     *  Create method
     *
     *  @return JsonResource|string
     */
    public function create(){
        $data = $this->getValidatedData('create');
        $model = $this->getModelClass()::create($data);
        return $this->resourceClassForCreate()::make($model)->additional($this->additionalDataForCreate());
    }

}
