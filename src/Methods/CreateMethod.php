<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Methods;

use Illuminate\Http\Resources\Json\JsonResource;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureResource;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureModel;
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
    public function resourceClassForIndex(): string
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
        return ["statusText" => "Created"];
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
