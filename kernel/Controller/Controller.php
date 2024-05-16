<?php
namespace App\Kernel\Controller;

use App\Kernel\View\View;
use App\Kernel\Http\Request;
use App\Kernel\Http\RedirectInterface;

abstract class Controller
{
   private View $view;
   private Request $request;
   private RedirectInterface $redirect;

   public function request(): Request
    {
        return $this->request;
    }
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

   public function view(string $name): void
   {
       $this->view->page($name);
   } 
   public function setView(View $view): void
    {
        $this->view = $view;
    }
    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }


  
    
}