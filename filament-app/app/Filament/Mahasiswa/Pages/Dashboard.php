<?php

namespace App\Filament\Mahasiswa\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.mahasiswa.pages.dashboard';

    protected static ?string $title = 'Dashboard Mahasiswa';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

}
