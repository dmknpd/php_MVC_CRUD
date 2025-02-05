<?php

namespace App\Controllers;

use Core\Controller\Controller;

class RegisterController extends Controller
{

  public function create(): void
  {
    $this->view('auth.register');
  }

  public function store()
  {
    $validation = $this->request()->validate([
      'name' => ['required', 'min:3', 'max:32'],
      'email' => ['required', 'email'],
      'password' => ['required', 'min:4', 'confirmed'],
      'password_confirmation' => ['required', 'min:4']
    ]);

    if (!$validation) {
      foreach ($this->request()->errors() as $field => $errors) {
        $this->session()->set($field, $errors);
      }
      $this->redirect('/register');
    }

    $user = [
      'name' => $this->request()->input('name'),
      'email' => $this->request()->input('email'),
      'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
    ];

    // $seller = [
    // ];

    $this->db()->insert('users', $user);

    $this->redirect('/');
  }
}
