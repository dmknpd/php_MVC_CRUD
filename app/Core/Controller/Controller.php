<?php

namespace Core\Controller;

use Core\Request\Request;
use Core\View\View;

abstract class Controller
{
  private View $view;
  private Request $request;

  public function __construct(View $view, Request $request)
  {
    $this->view = $view;
    $this->request = $request;
  }

  public function view(string $name): void
  {
    $this->view->page($name);
  }

  public function request()
  {
    return $this->request;
  }
}
