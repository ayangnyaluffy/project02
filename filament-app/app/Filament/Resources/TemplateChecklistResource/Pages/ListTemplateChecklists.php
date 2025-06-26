<?php

namespace App\Filament\Resources\TemplateChecklistResource\Pages;

use App\Filament\Resources\TemplateChecklistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplateChecklists extends ListRecords
{
    protected static string $resource = TemplateChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
