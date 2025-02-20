<?php

namespace App\Models;

use Core\Model\Model;

class Plant extends Model
{
  protected static string $table = 'plants';

  public static function allWithSeller(): array
  {
    return self::allWithJoin(
      'sellers',
      'plants.seller_id = sellers.id',
      ['plants.*', 'sellers.name', 'sellers.location', 'sellers.user_id'],
      orderBy: 'plants.id'
    );
  }

  public static function findBySeller(int $sellerId): array
  {
    return self::allWithJoin(
      'sellers',
      'plants.seller_id = sellers.id',
      columns: [
        'plants.id',
        'plants.title',
        'plants.description',
        'plants.price',
        'sellers.id AS seller_id',
        'sellers.name AS seller_name'
      ],
      conditions: ['seller_id' => $sellerId],
      orderBy: 'plants.id'
    );
  }
}
