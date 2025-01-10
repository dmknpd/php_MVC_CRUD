<?php

namespace App\Controllers;

use Core\Controller\Controller;

class PlantController extends Controller
{
  public function index(): void
  {
    $this->view('plants.index');
  }
}
