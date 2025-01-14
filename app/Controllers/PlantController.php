<?php

namespace App\Controllers;

use Core\Controller\Controller;
use Core\Validator\Validator;

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
    ]);

    if (!$validation) {
      dd('Validation failed', $this->request()->errors());
    }

    dd('Validation passed');
  }
}
