<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'img_path',
        'category_id',
        'module_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function badgeCollections(){
        return $this->hasMany(BadgeCollection::class);
    }
}
