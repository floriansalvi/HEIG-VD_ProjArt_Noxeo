<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'store_id'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function users() {
        return $this->hasMany(User::class, 'registration_key_id');
    }
}
