<?php

namespace Core\Controller;

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
    private SessionInterface $session
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
}
