<?php

namespace App\Middleware;

use Core\Middleware\AbstractMiddleware;

class EditMiddleware extends AbstractMiddleware
{
  public function handle(): void
  {
    $plant_id = $this->extractIdFromUrl($this->request->uri());

    if (!$this->isUserPlant($plant_id)) {
      $this->redirect->to('/');
    }
  }

  private function extractIdFromUrl(string $url): ?int
  {
    $parts = explode('/', trim($url, '/'));

    if (isset($parts[1]) && is_numeric($parts[1])) {
      return (int) $parts[1];
    }

    return null;
  }

  private function isUserPlant(int $plant_id): bool
  {
    foreach ($this->auth->plants() as $user_plant) {
      if ($user_plant['id'] === $plant_id) {
        return true;
      }
    }
    return false;
  }
}
