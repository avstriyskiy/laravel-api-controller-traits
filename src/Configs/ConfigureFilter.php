<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


/**
 *  Trait for filter.
 */
trait ConfigureFilter
{
    /**
     *  This method defines if you need a filtration for your Http Method.
     *  By default filtration is enabled.
     *  If you want to disable filtration you have to redefine this method in your Controller
     *
     *  @return bool
     */
    public function needFilter(): bool
    {
        return true;
    }


    /**
     *  Returns allowed filter fields 
     *
     *  @return string[]
     */
    public function getAllowedFilters(): array
    {
        return [AllowedFilter::exact('id'),];
    }

    /**
     *  Applies filter on builder. 
     *
     *  @param QueryBuilder $builder
     *  @return QueryBuilder
     */
    public function applyFiltering(QueryBuilder $builder): QueryBuilder
    {
        if ($this->needFilter()){
            $builder->allowedFilters($this->getAllowedFilters());
        }
        return $builder;
    }
}

