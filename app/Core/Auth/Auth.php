<?php

namespace Core\Auth;

use App\Models\Plant;
use App\Models\Seller;
use App\Models\User;
use Core\Config\Config;
use Core\Config\ConfigInterface;
use Core\Session\SessionInterface;

class Auth implements AuthInterface
{
  private ?ConfigInterface $config = null;

  public function __construct(
    private SessionInterface $session,
  ) {}

  private function getConfig(): ConfigInterface
  {
    if ($this->config === null) {
      $this->config = Config::getInstance();
    }
    return $this->config;
  }

  public function attempt(string $username, string $password): bool
  {

    $user = User::findByEmail($username);

    if (!$user) {
      return false;
    }

    if (!password_verify($password, $user[$this->password()])) {
      return false;
    }

    $this->session->set($this->sessionField(), $user['id']);

    return true;
  }


  public function check(): bool
  {
    return $this->session->has($this->sessionField());
  }

  public function user(): ?array
  {
    if (! $this->check()) {
      return null;
    }

    $user =  User::find($this->session->get($this->sessionField()));

    return $user ?: null;
  }

  public function seller(): ?array
  {
    $user = $this->user();

    if (!$user) {
      return null;
    }

    $seller = Seller::findByUserId($user['id']);

    return $seller ?: null;
  }

  public function plants(): ?array
  {
    $seller = $this->seller();

    if (!$seller) {
      return null;
    }

    $plants = Plant::findBySeller($seller['id']);

    return $plants ?: null;
  }

  public function canEdit(int $plant_id): bool
  {
    $plants = $this->plants();

    if (!$plants) {
      return false;
    }

    foreach ($plants as $plant) {
      if ($plant['id'] === $plant_id) {
        return true;
      }
    }

    return false;
  }

  public function logout(): void
  {
    $this->session->remove($this->sessionField());
  }

  public function table(): string
  {
    return $this->getConfig()->get('auth.table', 'user');
  }

  public function username(): string
  {
    return $this->getConfig()->get('auth.username', 'email');
  }

  public function password(): string
  {
    return $this->getConfig()->get('auth.password', 'password');
  }

  public function sessionField(): string
  {
    return $this->getConfig()->get('auth.session_field', 'user_id');
  }
}
