<?php

namespace App\Models;

use Core\Model\Model;

class User extends Model
{
  protected static string $table = 'users';

  public static function findByEmail(string $email): ?array
  {
    return self::db()->select(static::$table, ['email' => $email]);
  }
}
