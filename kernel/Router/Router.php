<?php
namespace App\Kernel\Router;

use App\Kernel\View\ViewInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Session\SessionInterface;
//класс, отвечающий за обработку маршрутов//
class Router implements RouterInterface
{   
    private array $routes = [
        'GET' => [],
        'POST'=> [],
    ];
    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        )
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
            /** @var Controller $controller **/
            $controller = new $controller();
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
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