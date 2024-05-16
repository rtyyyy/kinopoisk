<?php
namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\View\View;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;

class Container
{
    public readonly  Request $request;
    public readonly  Router $router;
    public readonly  View $view;
    public readonly  ValidatorInterface $validator;
    public readonly RedirectInterface $redirect;
    public function __construct()
    {
        $this->registerServices();
    }
    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->view = new View();
        $this->redirect = new Redirect();
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
        $this->router = new Router($this->view, $this-> request,  $this->redirect);
    }
    
}