<?php

namespace Core\Validator;

use App\Models\User;

class Validator implements ValidatorInterface
{
  private array $errors = [];
  private array $data;

  public function validate(array $data, array $rules): bool
  {
    $this->errors = [];
    $this->data = $data;

    foreach ($rules as $key => $rule) {

      $rules = $rule;

      foreach ($rules as $rule) {
        $rule = explode(':', $rule);

        $ruleName = $rule[0];
        $ruleValue = $rule[1] ?? null;

        $error = $this->validateRule($key, $ruleName, $ruleValue);

        if ($error) {
          $this->errors[$key][] = $error;
        }
      }
    }

    return empty($this->errors);
  }

  public function errors(): array
  {
    return $this->errors;
  }

  private function validateRule(string $key, string $ruleName, string $ruleValue = null): string|false
  {
    $value = $this->data[$key];

    switch ($ruleName) {
      case 'required':
        if ($value === null || $value === '') {
          return "Field {$key} is required";
        }
        break;

      case 'min':
        if (strlen($value) < $ruleValue) {
          return "Field {$key} must be at least {$ruleValue} characters long";
        }
        break;

      case 'max':
        if (strlen($value) > $ruleValue) {
          return "Field {$key} must be at most {$ruleValue} characters long";
        }
        break;

        //Email

      case 'email':
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          return "Field {$key} must be a valid email address";
        }
        break;

      case 'unique':
        if ($this->isEmailTaken($value)) {
          return "This {$key} is already in use";
        }
        break;

        //Numbers

      case 'numeric':
        if (!is_numeric($value)) {
          return "Field {$key} must be a number";
        }
        break;

      case 'positive':
        if ($value <= 0) {
          return "Field {$key} must be greater than 0";
        }
        break;

        //confirmation

      case 'confirmed':
        if ($value !== $this->data[$key . '_confirmation']) {
          return "Field {$key} must be confirmed";
        }
        break;
    }

    return false;
  }

  private function isEmailTaken(string $email): bool
  {
    $user = User::findByEmail($email);
    return !empty($user);
  }
}
