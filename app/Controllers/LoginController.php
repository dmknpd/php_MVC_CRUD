<?php

namespace App\Controllers;

use Core\Controller\Controller;

class LoginController extends Controller
{

  public function create(): void
  {
    $this->view('auth.login');
  }

  public function store()
  {
    $email = $this->request()->input('email');
    $password = $this->request()->input('password');

    dd($this->auth()->attempt($email, $password), $_SESSION);
  }
}
