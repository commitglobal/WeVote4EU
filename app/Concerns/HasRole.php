<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Enums\UserRole;

trait HasRole
{
    public function initializeHasRole()
    {
        $this->casts['role'] = UserRole::class;

        $this->fillable[] = 'role';
    }

    public function hasRole(UserRole | string $role): bool
    {
        return $this->role->is($role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(UserRole::ADMIN);
    }

    public function isAuthor(): bool
    {
        return $this->hasRole(UserRole::AUTHOR);
    }
}
