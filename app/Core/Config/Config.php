<?php

namespace Core\Config;

use InvalidArgumentException;

class Config
{

  private static ?self $instance = null;

  private array $config = [];


  private function __construct()
  {

    $this->config = $this->loadConfig();
  }


  public static function getInstance(): self
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }


  private function loadConfig(): array
  {

    $config = [];
    $configFiles = glob(APP_PATH . "/app/config/*.php");

    foreach ($configFiles as $file) {
      $config[basename($file, '.php')] = require $file;
    }

    return $config;
  }

  public function get(string $name, $default = null): mixed
  {
    if (strpos($name, '..') !== false) {
      throw new InvalidArgumentException("Invalid path: '{$name}'");
    }

    [$file, $key] = explode('.', $name);

    if ($key === null) {
      throw new InvalidArgumentException("Invalid config key.");
    }

    return $this->config[$file][$key] ?? $default;
  }
}
