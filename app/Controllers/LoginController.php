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


    if (!$this->auth()->attempt($email, $password)) {

      $this->session()->set('login_error', 'Wrong email or password');

      $this->redirect('/login');
    }

    $this->redirect('/');
  }

  public function destroy()
  {
    $this->auth()->logout();

    $this->redirect('/');
  }
}
