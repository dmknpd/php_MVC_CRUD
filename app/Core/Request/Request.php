<?php

namespace Core\Request;

use Core\Validator\Validator;

class Request
{


  public function __construct(
    private array $get,
    private array $post,
    private array $server,
    private array $files,
    private array $cookies,

    private Validator $validator,
  ) {}

  public static function createFromGlobals(Validator $validator): static
  {
    return new static($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE, $validator);
  }

  public function uri(): string
  {
    return strtok($this->server['REQUEST_URI'], '?');
  }

  public function method(): string
  {
    return $this->server['REQUEST_METHOD'];
  }

  public function input(string $key, $default = null): mixed
  {
    return $this->post[$key] ?? $this->get[$key] ?? $default;
  }

  public function validate(array $rules): bool
  {
    $data = [];

    foreach ($rules as $field => $rule) {
      $data[$field] = $this->input($field);
    }

    return $this->validator->validate($data, $rules);
  }

  public function errors(): array
  {
    return $this->validator->errors();
  }
}
