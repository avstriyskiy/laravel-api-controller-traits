<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

/**
 *  Trait to configure Model relations to be used in data loading for JsonResponse.
 */
trait ConfigureRelationsForModel
{
    /**
    *  Relations would not be loaded if array is empty.
    *
    *  @return array
    */ 
    public function getRelations(): array
    {
        return [];
    }
}
