<?php

declare(strict_types=1);

namespace App\Filament\Resources\ElectionDayResource\Pages;

use App\Filament\Resources\ElectionDayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ManageElectionDays extends ListRecords
{
    protected static string $resource = ElectionDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
