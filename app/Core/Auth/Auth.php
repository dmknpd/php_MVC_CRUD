<?php

namespace Core\Auth;

use Core\Config\ConfigInterface;
use Core\Database\DatabaseInterface;
use Core\Session\SessionInterface;

class Auth implements AuthInterface
{
  public function __construct(
    private DatabaseInterface $db,
    private SessionInterface $session,
    private ConfigInterface $config
  ) {}

  public function attempt(string $username, string $password): bool
  {

    $user = $this->db->first($this->table(), [
      $this->username() => $username
    ]);

    if (!$user) {
      return false;
    }

    if (!password_verify($password, $user[$this->password()])) {
      return false;
    }

    $this->session->set($this->sessionField(), $user['id']);

    return true;
  }

  public function logout(): void {}

  public function check(): bool {}

  public function user(): ?array {}

  public function table(): string
  {
    return $this->config->get('auth.table', 'user');
  }

  public function username(): string
  {
    return $this->config->get('auth.username', 'email');
  }

  public function password(): string
  {
    return $this->config->get('auth.password', 'password');
  }

  public function sessionField(): string
  {
    return $this->config->get('auth.session_field', 'user_id');
  }
}
