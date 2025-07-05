<?php

namespace App\Filament\User\Resources\ChecklistUserResource\Pages;

use App\Filament\User\Resources\ChecklistUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateChecklistUser extends CreateRecord
{
    protected static string $resource = ChecklistUserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = 1; // nanti diganti auth()->id()
        $data['is_completed'] = false;
        return $data;
    }
}
