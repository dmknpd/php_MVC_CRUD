<?php

namespace Core\Validator;

interface ValidatorInterface
{
  public function validate(array $data, array $rules): bool;

  public function errors(): array;
}
