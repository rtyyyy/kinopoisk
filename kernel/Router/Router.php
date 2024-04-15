<?php
namespace App\Kernel\Router;

//класс, отвечающий за обработку маршрутов//
class Router
{   
    private array $routes = [
        'GET' => [],
        'POST'=> [],
    ];
    public function __construct()
    {
        $this->initRoutes();
    }

//обработка маршрута//
    public function dispatch(string $uri, string $method ): void
    {
        $route = $this->findRoute($uri, $method);
        if(! $route){
            $this->notFound();
        }
        if(is_array($route->getAction())){
            [$controller, $action] = $route->getAction();
            $controller = new $controller();
            call_user_func([$controller, $action]);
        } else{
            call_user_func($route->getAction());
            
        }
        
    }



    private function notFound():void
    {
        echo '404 | not found';
        exit;
    }
    private function findRoute(string $uri, $method): Route|false
    {
        if(!isset($this->routes[$method][$uri])){
            return false;
        }
        return $this->routes[$method][$uri];
    }
    //разбиваем файлы из routes по get и post//
    private function initRoutes()
    {
        $routes = $this->getRoutes();
        foreach($routes as $route){
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
        
    }
    
    /** 
     *  @return Route[]
    */
    private function getRoutes(): array
    {
        return require_once APP_PATH.'/config/routes.php'; //получаем все маршруты//
    }
}