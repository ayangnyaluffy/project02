<?php

namespace App\Filament\Resources\TemplateChecklistResource\Pages;

use App\Filament\Resources\TemplateChecklistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateChecklist extends EditRecord
{
    protected static string $resource = TemplateChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
