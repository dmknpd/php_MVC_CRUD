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

    $data = [
      'title' => $this->request()->input('title'),
      // 'description' => $this->request()->input('description'),
      // 'price' => $this->request()->input('price')
    ];

    $testData = [
      'seller_id' => 22,
      'description' => "TEST TEST TEST",
      'price' => 228.00,
    ];

    $testArray = $data + $testData;

    $id = $this->db()->insert('plants', $testArray);

    dd("Plant added id: {$id}");
  }
}
