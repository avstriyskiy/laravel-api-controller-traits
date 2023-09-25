<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;




/**
 * Trait to configure JsonResource and ResourceCollections classes.
*/
trait ConfigureResource
{
    /**
    *   In base variant this method returns JsonResource::class
    *   You can redefine it in controller to use your custom Resources in all Methods.
    *   
    *   @return string|JsonResource
    */
    public function getResource(): string
    {
        return JsonResource::class;
    }

    /**
    *   In base variant this method returns ResourceCollection::class
    *   You can redefine it in controller to use your custom Collections in all Methods.
    *   
    *   @return string|ResourceCollection
    */
    public function getCollection(): string
    {
        return ResourceCollection::class;
    }
}
