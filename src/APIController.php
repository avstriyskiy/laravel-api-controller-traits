<?php

namespace Avstriyskiy\LaravelApiControllerTraits;

use Avstriyskiy\LaravelApiControllerTraits\Methods\CreateMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\DeleteMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\GetMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\IndexMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\UpdateMethod;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class APIController extends BaseController
{
    use IndexMethod, GetMethod, CreateMethod, UpdateMethod, DeleteMethod, AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
