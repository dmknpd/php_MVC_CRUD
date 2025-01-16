<?php

namespace App\Controllers;

use App\Models\Plant;
use Core\Controller\Controller;

class PlantController extends Controller
{
  private Plant $plantModel;

  public function __construct(
    Plant $plantModel
  ) {
    $this->plantModel = $plantModel;
  }

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
    $data = $this->request()->post();

    $validation = $this->request()->validate($data, [
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

    $filteredData = $this->request()->filteredData();

    $testData = [
      'seller_id' => 22,
      'description' => "TEST TEST TEST",
      'price' => 228.00,
    ];
    $testArray = $filteredData + $testData;

    $id = $this->db()->insert('plants', $testArray);

    dd("Plant added id: {$id}");
  }
}
