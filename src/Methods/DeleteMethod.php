<?php

namespace Avstriyskiy\LaravelApiControllerTraits\Methods;

use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureExceptionClass;
use Avstriyskiy\LaravelApiControllerTraits\Configs\ConfigureModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait DeleteMethod
{
    use ConfigureModel, ConfigureExceptionClass;
    

    /**
    *  Throws custom exception when you can't find Model. You can redefine it in your Controller.
    *  
    *  @return string
    */
    public function getModelNotFoundExceptionClassForDelete(): string
    {
        return $this->getModelNotFoundExceptionClass();
    }
    
    /**
    *   Default response text. You can redefine this method in your Controller.
    *
    *   @return array
    */
    public function responseForDelete(): array
{
    return ["statusText" => "Deleted"];
}
    /**
    *  Base Delete Method
    *
    *  @param int $id
    *  @return Application|ResponseFactory|Response
    */
    public function delete(int $id)
    {
        try {
            $model = $this->getModelClass()::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            $modelNotFoundException = $this->getModelNotFoundExceptionClassForDelete();
            throw new $modelNotFoundException();
        }
        $model->delete();
        
        return response($this->responseForDelete());
    }
}
