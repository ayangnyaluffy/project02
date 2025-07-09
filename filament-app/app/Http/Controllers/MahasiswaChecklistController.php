<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use Illuminate\Support\Facades\Auth;

class MahasiswaChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::with('items')
            ->where('user_id', Auth::guard('mahasiswa')->id())
            ->get();

        return view('filament.mahasiswa.pages.checklist-saya', compact('checklists'));
    }

    public function update(Request $request)
    {
        $itemsByChecklist = $request->input('items', []);

        foreach ($itemsByChecklist as $checklistId => $itemIds) {
            \App\Models\Item::where('checklist_id', $checklistId)
                ->update(['is_checked' => false]);

            \App\Models\Item::whereIn('id', $itemIds)
                ->where('checklist_id', $checklistId)
                ->update(['is_checked' => true]);
        }

        return redirect()->back()->with('status', 'Checklist berhasil diperbarui.');
    }
}
