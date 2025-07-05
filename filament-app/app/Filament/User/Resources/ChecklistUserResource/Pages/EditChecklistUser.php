<?php

namespace App\Filament\User\Resources\ChecklistUserResource\Pages;

use App\Filament\User\Resources\ChecklistUserResource;
use Filament\Resources\Pages\EditRecord;

class EditChecklistUser extends EditRecord
{
    protected static string $resource = ChecklistUserResource::class;

    protected function authorizeAccess(): void
    {
        // untuk sementara tanpa login
        // abort_unless(auth()->id() === $this->record->user_id, 403);
    }
}
