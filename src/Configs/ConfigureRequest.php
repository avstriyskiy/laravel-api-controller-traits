<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Configs;

/**
 *  Trait to configure custom Requests
 */
trait ConfigureRequest
{
    /**
     *   This method returns validated request. Request must be in folder Requests/.
     *   And it must contain this regex in name "{$entityName}/{$action}{$entityName}Request.php"
     *   This means {DIRECTORY}{ACTION}{ENTITY_NAME}Request.php
     *   For example: User/CreateUserRequest.php
     *   
     *   It fits for base CRUD purposes, and you cannot redefine this method, because if you need to redefine it,
     *   so it is not a more base CRUD.
     *
     *   @param string $action
     *   @return array
     *
     */
    protected function getValidatedData(string $action): array
    {
        $action = ucfirst($action);
        $entityName = explode('\\', $this->getModelClass());
        $entityName = $entityName[count($entityName -1)];

        $requestClassName = "App\Http\Requests\SPA\\{$entityName}\\{$action}{$entityName}Request";
        
        if (class_exists($requestClassName)) {
            $request = app($requestClassName);
            return $request->validated();
        }
        return request()->json()->all();
    }
}
