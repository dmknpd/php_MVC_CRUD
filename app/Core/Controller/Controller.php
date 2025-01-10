<?php

namespace Core\Controller;

use Core\View\View;

abstract class Controller
{
  private View $view;

  public function view(string $name): void
  {
    $this->view->page($name);
  }

  public function setView(View $view): void
  {
    $this->view = $view;
  }
}
