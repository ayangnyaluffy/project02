<?php

namespace App\Filament\User\Resources\ItemUserResource\Pages;

use App\Filament\User\Resources\ItemUserResource;
use Filament\Resources\Pages\ListRecords;

class ListItemUser extends ListRecords
{
    protected static string $resource = ItemUserResource::class;
}
