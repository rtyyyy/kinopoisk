<?php
namespace App\Kernel;

//класс, отвечающий за запуск приложения//
use App\Kernel\Router\Router;
use App\Kernel\Http\Request;

class App
{
    public function run(): void
    {
        $router = new Router();
        $request = Request::createFromGlobals();
        $router->dispatch($request->uri(),$request->method());
    }
}