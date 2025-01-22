<?php

namespace Core\View;

use Core\Auth\AuthInterface;
use Core\Exceptions\ViewNotFoundException;
use Core\Session\SessionInterface;
use InvalidArgumentException;

class View implements ViewInterface
{

  public function __construct(
    private SessionInterface $session,
    private AuthInterface $auth
  ) {}

  public function page(string $name): void
  {
    $filePath = $this->prepPath($name);

    if (!file_exists($filePath)) {
      throw new ViewNotFoundException("View not found: {$filePath}");
    }

    extract($this->defaultData());

    include_once $filePath;
  }

  public function prepPath(string $name): string
  {
    if (strpos($name, '..') !== false) {
      throw new InvalidArgumentException("Invalid path: '{$name}'");
    }

    [$folder, $file] = explode('.', $name);

    if ($file === null) {
      throw new InvalidArgumentException("Invalid page name.");
    }

    return APP_PATH . "/resources/views/{$folder}/{$file}.php";
  }

  public function component(string $name): void
  {

    $filePath = APP_PATH . "/resources/views/components/{$name}.php";

    if (!file_exists($filePath)) {
      echo "Component not found: {$filePath}";
      return;
    }

    extract($this->defaultData());

    include_once $filePath;
  }

  private function defaultData(): array
  {
    return [
      'view' => $this,
      'session' => $this->session,
      'auth' => $this->auth
    ];
  }
}
