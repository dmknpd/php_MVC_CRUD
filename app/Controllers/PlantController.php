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
    dd($this->request()->input('title'));
  }
}
