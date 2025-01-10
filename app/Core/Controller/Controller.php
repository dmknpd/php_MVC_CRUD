<?php

namespace Core\Controller;

use Core\View\View;

abstract class Controller
{
  protected View $view;

  public function __construct(View $view)
  {
    $this->view = $view;
  }

  public function view(string $name): void
  {
    $this->view->page($name);
  }
}
