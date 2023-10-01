# Laravel API Controller traits
This package allows you to use basic Index, Get, Create, Update and Delete methods based on traits. Also package provides an abstract class that using all these traits, so you can just simply extend this class.
You can customize Response, Resources and Collections just by implementing methods in your controller.

## Basic usage
Here is an example of controller which just extends APIController class. It contains all methods.
You must declare public ```getModelClass()``` method which returns Model class name.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Avstriyskiy\LaravelApiControllerTraits\APIController;

class UserController extends APIController
{
    public function getModelClass(): string
    {
        return User::class;
    }
}
```

If you don't need all methods you can use traits in your controller like in this example. You still have to declare public ```getModelClass()``` method.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Avstriyskiy\LaravelApiControllerTraits\Methods\IndexMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\GetMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\CreateMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\UpdateMethod;
use Avstriyskiy\LaravelApiControllerTraits\Methods\DeleteMethod;

class UserController extends Controller
{
    use IndexMethod, GetMethod, CreateMethod, UpdateMethod, DeleteMethod;

    public function getModelClass(): string
    {
        return User::class;
    }
}
```
## Defining requests
You have to create request

## List of available methods
- [getRelations()](#getrelations)
- [getResource()](#getresource)
- [getCollection()](#getcollection)
- [getModelNotFoundExceptionClass()](#getmodelnotfoundexceptionclass)
- [additionalDataForMethod()](#additionaldataformethod)
- [resourceClassForMethod()](#resourceclassformethod)
- [getModelNotFoundExceptionClassForMethod()](#getmodelnotfoundexceptionclassformethod)


## Available customization
If you need any additional options for your controller, you can just declare methods.<br><br>
##### ```getRelations()``` 
Method allows you to load relations for your model when preparing Resource. <br>
By default it returns an empty array. 
```php
class UserController extends APIController
{
    ...
    public function getRelations(): array
    {
        return ["phones", "comments"];
    }
}
```
<br><br>
##### ```getResource()``` 
Method allows you to define custom Resource to be used for response in Get, Create and Update Methods. <br>
By default it returns a JsonResource::class
```php
class UserController extends APIController
{
    ...
    public function getResource(): string
    {
        return UserResource::class;
    }
}
```
<br><br>
##### ```getCollection()``` 
Method allows you to define custom Collection to be used for response. <br>
By default it returns a ResourceCollection::class
```php
class UserController extends APIController
{
    ...
    public function getCollection(): string
    {
        return UserCollection::class;
    }
}
```
<br><br>
##### ```getModelNotFoundExceptionClass()``` 
Method allows you to define custom Exception class to be used when model is not found in DB. <br>
By default it returns an IlluminateModelNotFoundException::class
```php
class UserController extends APIController
{
    ...
    public function getModelNotFoundExceptionClass(): string
    {
        return IlluminateModelNotFoundException::class;
    }
}
```
<br><br>
##### ```additionalDataFor%METHOD%()``` 
You can add an additional data for your JsonResponse simply defining this kind of methods returnin array of additional data. <br>
By default they return an empty array.
```php
class UserController extends APIController
{
    ...
    public function addditionalDataForIndex(): array
    {
        return ["statusText" => "Success"];
    }

    public function additionalDataForCreate(): array
    {
        return ["statusText" => "Created"];
    }
}
```
<br><br>
##### ```resourceClassFor%METHOD%()``` 
Also you can define custom resource/collection class for single method. <br> Signature is the same for IndexMethod for more compitability, but it should return a collection class like in example. <br>
By default these methods return ```getResource()``` or ```getCollection()``` methods.

```php
class UserController extends APIController
{
    ...
    public function resourceClassForIndex(): string
    {
        return UserCollection::class;
    }

    public function resourceClassForGet(): string
    {
        return UserResource::class;
    }
}
```
<br><br>
##### ```getModelNotFoundExceptionClassFor%METHOD%()``` 
Method allows you to define different custom Exception class to be used when model is not found in DB. <br>
By default it returns a getModelNotFoundException()
```php
class UserController extends APIController
{
    ...
    public function getModelNotFoundExceptionClassForGet(): string
    {
        return GetModelNotFoundException::class;
    }
    public function getModelNotFoundExceptionClassForDelete(): string
    {
        return $this->getMOdelNotFoundExceptionClass();
    }
}
```
<br><br>
