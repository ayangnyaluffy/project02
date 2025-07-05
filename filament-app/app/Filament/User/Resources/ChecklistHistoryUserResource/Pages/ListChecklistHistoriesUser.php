<?php

namespace App\Filament\User\Resources\ChecklistHistoryUserResource\Pages;

use App\Filament\User\Resources\ChecklistHistoryUserResource;
use Filament\Resources\Pages\ListRecords;

class ListChecklistHistoryUser extends ListRecords
{
    protected static string $resource = ChecklistHistoryUserResource::class;

    protected function getHeaderActions(): array
    {
        return []; // Hapus tombol "Create"
    }
}
