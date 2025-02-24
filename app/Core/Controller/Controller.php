<?php

namespace Core\Controller;

use Core\Auth\AuthInterface;
use Core\Database\DatabaseInterface;
use Core\Redirect\RedirectInterface;
use Core\Request\RequestInterface;
use Core\Session\SessionInterface;
use Core\View\ViewInterface;

abstract class Controller
{
  public function __construct(
    private ViewInterface $view,
    private RequestInterface $request,
    private RedirectInterface $redirect,
    private SessionInterface $session,
    private AuthInterface $auth
  ) {
    $this->view = $view;
    $this->request = $request;
    $this->redirect = $redirect;
    $this->session = $session;
    $this->auth = $auth;
  }

  public function view(string $name, array $data = []): void
  {
    $this->view->page($name, $data);
  }

  public function request(): RequestInterface
  {
    return $this->request;
  }

  public function redirect(string $url): RedirectInterface
  {
    return $this->redirect->to($url);
  }

  public function session(): SessionInterface
  {
    return $this->session;
  }

  public function auth(): AuthInterface
  {
    return $this->auth;
  }
}
