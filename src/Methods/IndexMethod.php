<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Methods;

use Illuminate\Http\Resources\Json\ResourceCollection;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureFilter;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureModel;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigurePagination;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureRelationsForModel;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureResource;
use avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureSort;


/*
 * This trait implements an IndexMethod to your Controller so you can get 
 * all entities by only using this trait.
 * 
 * You have to specify Route in your router for Index
*/
trait IndexMethod
{
    use ConfigureModel, ConfigureResource, ConfigureRelationsForModel, ConfigureFilter, ConfigureSort, ConfigurePagination;

    /**
    *   This method returns Collection class for index method.
    *   You can redefine it in your Controller and in Index Method would be used different Collection class.
    *
    *   In Spatie\QueryBuilder library if you type wrong filter in includes param you would get an exception.
    *   Here mistakes in includes param would be ignored.
    *
    *   @return string|ResourceCollection
    */
    public function resourceClassForIndex(): string
    {
        return ResourceCollection::class;
    }
    
    /**
    *   This method returns array of additional information for your response.
    *   You can redefine it in your Controller.
    *
    *   @return string|ResourceCollection
    */
    public function additionalDataForIndex(): string
    {
        return ["statusText" => "Success"];
    }

    
    /**
    *   Base Index method with pagination and filtering. 
    *
    *   @return string|ResourceCollection
    */
    public function index()
    {
        $builder = $this->getCustomBuilder();
        if ($this->getRelations()) {
        }
            $builder->with($this->getRelations());
        $builder =  $this->applyFiltering($builder);

        try {
            $builder->allowedIncludes($this->getRelations());    
        } catch (\Exception $e) {
            $validIncludes = [];
            foreach (request()->get("include") as $givenInclude) {
                foreach ($this->getRelations() as $relation) {
                    if ($relation == $givenInclude) {
                        $validIncludes[] = $givenInclude;
                    }
                }
            }
            $validIncludes = implode(',', $validIncludes);
            request()->query()->set("include", $validIncludes);
            $builder =  $this->applyFiltering($builder);
        }
        
        $builder = $this->applySorting($builder); 
        
        $paginateParams = $this->getPaginationParams();
        if (!$paginateParams['all'] && $this->needPaginate()) {
            $data = $builder->paginate($paginateParams['per_page']);
        } else {
            $data = $builder->get();
        }
        
        return $this->resourceClassForIndex()::make($data)->additional($this->additionalDataForIndex());
    }
}
