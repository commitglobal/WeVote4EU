<?php

declare(strict_types=1);

namespace App\Filament\Resources\ElectionDays\Pages;

use App\Filament\Resources\ElectionDays\ElectionDayResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ManageElectionDays extends ListRecords
{
    protected static string $resource = ElectionDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
