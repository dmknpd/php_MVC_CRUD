<?php

namespace App\Controllers;

use Core\Controller\Controller;

class PlantController extends Controller
{
  public function index(): void
  {
    $this->view('plants.index');
  }

  public function create(): void
  {
    $this->view('plants.create');
  }

  public function store()
  {
    $validation = $this->request()->validate([
      'title' => ['required', 'min:3', 'max:32'],
      // 'description' => ['required', 'min:3', 'max:5'],
      // 'price' => ['required', 'numeric', 'positive'],
    ]);

    if (!$validation) {
      foreach ($this->request()->errors() as $field => $errors) {
        $this->session()->set($field, $errors);
      }
      $this->redirect('/plants/create');
    }

    dd('Validation passed');
  }
}
