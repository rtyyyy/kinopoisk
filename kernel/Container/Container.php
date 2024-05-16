<?php
namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\View\View;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Router\RouterInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\View\ViewInterface;

class Container
{
    public readonly RequestInterface $request;
    public readonly RouterInterface $router;
    public readonly ViewInterface $view;
    public readonly  ValidatorInterface $validator;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public function __construct()
    {
        $this->registerServices();
    }
    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->redirect = new Redirect();
        $this->validator = new Validator();
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->request->setValidator($this->validator);
        $this->router = new Router($this->view, $this-> request,  $this->redirect, $this->session);
    }
    
}