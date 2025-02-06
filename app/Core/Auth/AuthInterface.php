<?php

namespace Core\Auth;

interface AuthInterface
{
  public function attempt(string $username, string $password): bool;

  public function check(): bool;

  public function user(): ?array;

  public function seller(): ?array;

  public function logout(): void;

  public function table(): string;

  public function username(): string;

  public function password(): string;

  public function sessionField(): string;
}
