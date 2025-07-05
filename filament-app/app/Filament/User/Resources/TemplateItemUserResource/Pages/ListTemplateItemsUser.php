<?php

namespace App\Filament\User\Resources\TemplateItemUserResource\Pages;

use App\Filament\User\Resources\TemplateItemUserResource;
use Filament\Resources\Pages\ListRecords;

class ListTemplateItemsUser extends ListRecords
{
    protected static string $resource = TemplateItemUserResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
