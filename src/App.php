<?php
namespace App;

//класс, отвечающий за запуск приложения//
use App\Router\Router;
use App\Http\Request;

class App
{
    public function run(): void
    {
        $router = new Router();
        $request = Request::createFromGlobals();
        $router->dispatch($request->uri(),$request->method());
    }
}