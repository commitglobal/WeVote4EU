<?php

declare(strict_types=1);

namespace App\Enums;

use App\Concerns\Enums\Arrayable;
use App\Concerns\Enums\Comparable;
use App\Concerns\Enums\HasLabel;

enum UserRole: string
{
    use Arrayable;
    use Comparable;
    use HasLabel;

    case ADMIN = 'admin';
    case AUTHOR = 'author';

    protected function labelKeyPrefix(): ?string
    {
        return 'app.user.role';
    }
}
