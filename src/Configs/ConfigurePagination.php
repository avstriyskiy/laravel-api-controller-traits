<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

/**
 *  Trait for base pagination
*/
trait ConfigurePagination
{
    /**
    *   This method allows you to enable and disable pagination for your Http Method.
    *   By default pagination is allowed. To disable it you have to redefine it in your Controller.
    *   
    *   @return bool    
    */
    protected function needPaginate(): bool
    {
        return true;
    }
    
    /**
    *   This method allows you to use different count of items per page
    *   Default value is 20.
    *   
    *   @return int 
    */
    public function getItemsCount(): int
    {
        return 20;   
    }

    /**
    *   Returns pagination params.
    *   all - to get all records in one page (like if pagination would be disabled)
    *   per_page - to set count of records per one page. (all has higher priority, so you can't use both)
    *   
    *   @return array    
    *   @throws ContainerExceptionInterface
    *   @throws NotFoundExceptionInterface
    */
    protected function getPaginationParams(): array
    {
        $all = request()->get("all") === "true";
        $perPage = request()->get("per_page", $this->getItemsCount());
        return [
            "all" => $all,
            "per_page" => $perPage,
        ];
    }
}
