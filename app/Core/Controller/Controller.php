<?php

namespace Core\Controller;

use Core\Redirect\Redirect;
use Core\Request\Request;
use Core\Session\Session;
use Core\View\View;

abstract class Controller
{
  public function __construct(
    private View $view,
    private Request $request,
    private Redirect $redirect,
    private Session $session
  ) {
    $this->view = $view;
    $this->request = $request;
    $this->redirect = $redirect;
    $this->session = $session;
  }

  public function view(string $name): void
  {
    $this->view->page($name);
  }

  public function request(): Request
  {
    return $this->request;
  }

  public function redirect(string $url): Redirect
  {
    return $this->redirect->to($url);
  }

  public function session(): Session
  {
    return $this->session;
  }
}
