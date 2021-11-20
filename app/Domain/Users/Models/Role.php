<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models;

class Role extends Models\Role
{
    use HasFactory;

    const ROLES = [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'moderator' => 'Moderator',
        'viewer' => 'Viewer',
    ];

    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
