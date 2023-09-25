<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

use Spatie\QueryBuilder\QueryBuilder;


/**
 *  Trait for sort
*/
trait ConfigureSort
{

    /**
     *  This method defines if you need a sort for your Http Method.
     *  By default sort is enabled. If you want to disable sort for Http Method you have to redefine it in your Controller
     *
     *  @return bool
     */
    public function needSort(): bool
    {
        return true;
    }

    /**
     *  This method defines if you need default sort by fields from getDefaultSorts() method.
     *  if needSort return value is false it will not count.
     *
     *  @return bool
     */
    public function needDefaultSort(): bool
    {
        return true;
    }

    /**
     *  Which fields to be sort by 
     *
     *  @return array 
     */
    public function getDefaultSorts(): array
    {
        return ['id'];
    }

    /**
     *  Allowed sort fields. 
     *
     *  @return array
     */
    public function getAllowedSorts(): array
    {
        return ['id'];
    }

    /**
     *  This method applies sort for builder
     *
     *  @param QueryBuilder $builder
     *  @return QueryBuilder
     */
    public function applySorting(QueryBuilder $builder): QueryBuilder
    {
        if ($this->needSort()){
            if ($this->needDefaultSort()){
                $builder->defaultSorts(...$this->getDefaultSorts());
            }
            $builder->allowedSorts(...$this->getAllowedSorts());
        }
        return $builder;
    }
}

    
