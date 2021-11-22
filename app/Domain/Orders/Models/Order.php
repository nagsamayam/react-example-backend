<?php

declare(strict_types=1);

namespace Domain\Orders\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function newFactory()
    {
        return OrderFactory::new();
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getTotalAttribute()
    {
        return $this->orderItems->sum(function (OrderItem $orderItem) {
            return $orderItem->quantity * $orderItem->price;
        });
    }
}
