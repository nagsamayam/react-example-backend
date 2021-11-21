<?php

declare(strict_types=1);

namespace Domain\Products\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return ProductFactory::new();
    }
}
