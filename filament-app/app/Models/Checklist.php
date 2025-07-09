<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TemplateItem;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'date', 'is_completed', 'template_checklist_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public static function booted(): void
    {
        static::created(function ($checklist) {
            if ($checklist->template_checklist_id) {
                $templateItems = TemplateItem::where('template_checklist_id', $checklist->template_checklist_id)->get();

                foreach ($templateItems as $templateItem) {
                    $checklist->items()->create([
                        'name' => $templateItem->name,
                        'quantity' => $templateItem->quantity,
                        'note' => $templateItem->note,
                        'is_checked' => false,
                    ]);
                }
            }
        });
    }

    public function templateChecklist()
    {
        return $this->belongsTo(TemplateChecklist::class);
    }
}
