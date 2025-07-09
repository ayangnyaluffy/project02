<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['checklist_id', 'name', 'quantity', 'note', 'is_checked', 'kategori'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function setKategoriAttribute($value)
    {
        $this->attributes['kategori'] = ucwords(strtolower($value));
    }
}

