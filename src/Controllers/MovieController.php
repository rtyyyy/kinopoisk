<?php

namespace App\Controllers;

use App\Kernel\View\View;
use App\Kernel\Controller\Controller;
use App\Kernel\Validator\Validator;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
        
    }
    public function add(): void
    {
        $this->view('admin/movies/add');
    }
    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
        ]);

        if (! $validation) {
            $this->redirect('/admin/movies/add');
            // dd('validation failed', $this->request()->errors());
        }
        dd('validation passed');
    }

}