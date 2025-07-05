<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateItem extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'name', 'quantity', 'note'];

    public function templateChecklist()
    {
        return $this->belongsTo(TemplateChecklist::class, 'template_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
