<?php

namespace App\Filament\Mahasiswa\Pages;

use App\Models\Checklist;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ChecklistSaya extends Page
{
    protected static string $view = 'filament.mahasiswa.pages.checklist-saya';

    protected static ?string $title = 'Checklist Saya';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Barang Saya';

    // ⬇️ Ini yang penting:
    protected function getViewData(): array
    {
        return [
            'checklists' => Checklist::with('items')
                ->where('user_id', Auth::guard('mahasiswa')->id())
                ->get(),
        ];
    }
}
