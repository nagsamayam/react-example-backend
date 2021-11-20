<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Database\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models;

class Permission extends Models\Permission
{
    use HasFactory;

    protected static function newFactory()
    {
        return PermissionFactory::new();
    }
}
