<?php
namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\View\View;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;

class Container
{
    public readonly  Request $request;
    public readonly  Router $router;
    public readonly  View $view;
    public readonly  ValidatorInterface $validator;
    public function __construct()
    {
        $this->registerServices();
    }
    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->view = new View();
        $this->router = new Router($this->view, $this-> request);
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
    }
    
}