<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateChecklist extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function items()
    {
        return $this->hasMany(TemplateItem::class, 'template_id');
    }
}
