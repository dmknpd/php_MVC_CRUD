<?php

namespace Core\Request;

use Core\Validator\ValidatorInterface;

class Request implements RequestInterface
{


  public function __construct(
    private array $get,
    private array $post,
    private array $server,
    private array $files,
    private array $cookies,

    private ValidatorInterface $validator,
  ) {}

  public static function createFromGlobals(ValidatorInterface $validator): static
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

  // public function input(string $key, $default = null): mixed
  // {
  //   return $this->post[$key] ?? $this->get[$key] ?? $default;
  // }

  public function post(): array
  {
    return $this->post;
  }

  public function validate(array $data, array $rules): bool
  {
    return $this->validator->validate($data, $rules);
  }

  public function filteredData(): array
  {
    return $this->validator->filteredData();
  }

  public function errors(): array
  {
    return $this->validator->errors();
  }
}
