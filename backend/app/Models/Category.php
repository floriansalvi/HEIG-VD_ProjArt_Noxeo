<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function modules() {
        return $this->hasMany(Module::class);
    }

    public function badges() {
        return $this->hasMany(Badge::class);
    }

    public function steps() {
        return $this->hasManyThrough(Step::class, Module::class, 'category_id', 'module_id', 'id', 'id');
    }
}
