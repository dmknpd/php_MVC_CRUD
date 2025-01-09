<?php

namespace App\Controllers;

class PlantController
{
  public function index(): void
  {
    include_once APP_PATH . "/resources/views/plants/index.php";
  }
}
