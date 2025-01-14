<?php

namespace Core\Redirect;

class Redirect
{
  public function to(string $url)
  {
    header("Location: {$url}");
    exit;
  }
}
