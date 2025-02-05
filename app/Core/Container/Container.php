<?php

namespace Core\Container;

use App\Models\User;
use Core\Auth\Auth;
use Core\Auth\AuthInterface;
use Core\Config\ConfigInterface;
use Core\Config\Config;
use Core\Database\Database;
use Core\Database\DatabaseInterface;
use Core\Model\ModelInterface;
use Core\Redirect\Redirect;
use Core\Redirect\RedirectInterface;
use Core\Request\Request;
use Core\Request\RequestInterface;
use Core\Router\Router;
use Core\Router\RouterInterface;
use Core\Session\Session;
use Core\Session\SessionInterface;
use Core\Validator\Validator;
use Core\Validator\ValidatorInterface;
use Core\View\View;
use Core\View\ViewInterface;

class Container
{
  public readonly RequestInterface $request;
  public readonly RouterInterface $router;
  public readonly ViewInterface $view;
  public readonly ValidatorInterface $validator;
  public readonly RedirectInterface $redirect;
  public readonly SessionInterface $session;
  public readonly ConfigInterface $config;
  public readonly AuthInterface $auth;

  public function __construct()
  {
    $this->registerServices();
  }

  private function registerServices()
  {
    $this->session = new Session();
    $this->validator = new Validator();
    $this->redirect = new Redirect();
    // $this->auth = new Auth($this->database, $this->session, $this->config);
    $this->view = new View($this->session);
    $this->request = Request::createFromGlobals($this->validator);
    $this->router = new Router(
      $this->view,
      $this->request,
      $this->redirect,
      $this->session,
    );
  }
}
