<?php

declare(strict_types=1);

namespace App\Enums;

use App\Concerns\Enums\Arrayable;
use App\Concerns\Enums\Comparable;
use App\Concerns\Enums\HasLabel;

enum Country: string
{
    use Arrayable;
    use Comparable;
    use HasLabel;

    case EU = 'eu';
    case AT = 'at';
    case BE = 'be';
    case BG = 'bg';
    case HR = 'hr';
    case CY = 'cy';
    case CZ = 'cz';
    case DK = 'dk';
    case EE = 'ee';
    case FI = 'fi';
    case FR = 'fr';
    case DE = 'de';
    case GR = 'gr';
    case HU = 'hu';
    case IE = 'ie';
    case IT = 'it';
    case LV = 'lv';
    case LT = 'lt';
    case LU = 'lu';
    case MT = 'mt';
    case NL = 'nl';
    case PL = 'pl';
    case PT = 'pt';
    case RO = 'ro';
    case SK = 'sk';
    case SI = 'si';
    case ES = 'es';
    case SE = 'se';

    protected function labelKeyPrefix(): ?string
    {
        return 'countries';
    }
}
