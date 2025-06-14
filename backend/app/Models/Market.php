<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img_path'
    ];

    public function stores() {
        return $this->hasMany(Store::class);
    }

    public function users() {
        return $this->hasManyThrough(User::class, Store::class);
    }
}
