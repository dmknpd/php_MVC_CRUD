<?php

namespace Core\Container;

use Core\Redirect\Redirect;
use Core\Request\Request;
use Core\Router\Router;
use Core\Session\Session;
use Core\Validator\Validator;
use Core\View\View;

class Container
{
  public readonly Request $request;
  public readonly Router $router;
  public readonly View $view;
  public readonly Validator $validator;
  public readonly Redirect $redirect;
  public readonly Session $session;

  public function __construct()
  {
    $this->registerServices();
  }

  private function registerServices()
  {
    $this->view = new View();
    $this->validator = new Validator();
    $this->redirect = new Redirect();
    $this->session = new Session();
    $this->request = Request::createFromGlobals($this->validator);
    $this->router = new Router($this->view, $this->request, $this->redirect, $this->session);
  }
}
