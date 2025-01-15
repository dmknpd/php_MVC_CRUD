<?php

namespace Core\Config;

use InvalidArgumentException;

class Config implements ConfigInterface
{
  public function get(string $name, $default = null): mixed
  {
    if (strpos($name, '..') !== false) {
      throw new InvalidArgumentException("Invalid path: '{$name}'");
    }

    [$file, $key] = explode('.', $name);

    if ($key === null) {
      throw new InvalidArgumentException("Invalid page name.");
    }

    $configPath =  APP_PATH . "/app/config/{$file}.php";

    if (!file_exists($configPath)) {
      return $default;
    }

    $config = require $configPath;

    return $config[$key] ?? $default;
  }
}
