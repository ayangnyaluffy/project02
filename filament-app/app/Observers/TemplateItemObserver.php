<?php

namespace App\Observers;

use App\Models\TemplateItem;
use App\Models\Checklist;
use App\Models\Item;
use App\Models\User;

class TemplateItemObserver
{
    public function created(TemplateItem $templateItem): void
    {
      
        $users = User::all();

        foreach ($users as $user) {
      
            $checklist = Checklist::firstOrCreate([
                'user_id' => $user->id,
                'template_checklist_id' => $templateItem->template_checklist_id,
            ], [
                'title' => $templateItem->templateChecklist->title ?? 'Checklist Baru',
                'date' => now(),
            ]);

          
            Item::create([
                'checklist_id' => $checklist->id,
                'name' => $templateItem->name,
                'is_checked' => false,
            ]);
        }
    }
}
