<?php

declare(strict_types=1);

namespace App\Enums;

use App\Concerns\Enums\Arrayable;
use App\Concerns\Enums\Comparable;
use App\Concerns\Enums\HasLabel;

enum StatKey: string
{
    use Arrayable;
    use Comparable;
    use HasLabel;

    case VOTES = 'votes';
    case OBSERVERS = 'observers';
    case POLLING_STATIONS = 'polling_stations';
    case STARTED_FORMS = 'started_forms';
    case QUESTIONS_ANSWERED = 'questions_answered';
    case FLAGGED_ANSWERS = 'flagged_answers';

    protected function labelKeyPrefix(): ?string
    {
        return 'app.stats';
    }
}
