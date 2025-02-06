<?php

namespace App\Controllers;

use App\Models\Seller;
use App\Models\User;
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
      'name' => ['required', 'min:2', 'max:32'],
      'email' => ['required', 'email', 'unique'],
      'password' => ['required', 'min:4', 'confirmed'],
      'password_confirmation' => ['required'],
      'company' => ['required', 'min:2', 'max:32'],
      'location' => ['required', 'min:2', 'max:32'],
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

    $user_id = User::create($user);

    if (!$user_id) {
      $this->session()->set('register_error', 'Failed to create user. Please try again.');
      $this->redirect('/register');
    }

    $seller = [
      'user_id' => $user_id,
      'name' => $this->request()->input('company'),
      'location' => $this->request()->input('location'),
    ];

    Seller::create($seller);

    $this->redirect('/');
  }
}
