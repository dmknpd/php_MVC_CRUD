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
    $validation = $this->request()->validate([
      'email' => ['required', 'email'],
      'password' => ['required', 'min:4'],
    ]);

    if (!$validation) {
      $this->session()->set('error', 'Wrong email or password');

      $this->redirect('/login');
    }

    $data = [
      'email' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
      'password' => $this->request()->input('password')
    ];

    $id = $this->db()->insert('users', $data);

    dd("User added id: {$id}");
  }
}
