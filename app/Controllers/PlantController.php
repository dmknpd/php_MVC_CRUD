<?php

namespace App\Controllers;

use App\Models\Plant;
use Core\Controller\Controller;

class PlantController extends Controller
{

  public function index(): void
  {
    $plants = Plant::allWithSeller();

    $this->view('plants.index', ['plants' => $plants]);
  }

  public function create(): void
  {
    $this->view('plants.create');
  }

  public function store()
  {
    $validation = $this->request()->validate([
      'title' => ['required', 'min:3', 'max:32'],
      'description' => ['required', 'min:3', 'max:5'],
      'price' => ['required', 'numeric', 'positive'],
    ]);

    if (!$validation) {
      foreach ($this->request()->errors() as $field => $errors) {
        $this->session()->set($field, $errors);
      }
      $this->redirect('/plants/create');
    }

    $data = [
      'title' => $this->request()->input('title'),
      'description' => $this->request()->input('description'),
      'price' => $this->request()->input('price')
    ];

    $seller = $this->auth()->seller()['id'];

    if (!$seller) {
      $this->session()->set('create-plant_error', 'Failed to create plant. Please try again.');
      $this->redirect('/plant/create');
    }

    $data['seller_id'] = $seller;

    Plant::create($data);

    //TODO: add success notification

    $this->redirect('/');
  }
}
