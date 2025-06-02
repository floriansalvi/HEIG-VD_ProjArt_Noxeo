<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'zip_code',
        'city',
        'email',
        'phone',
        'market_id',
    ];

    public function market() {
        return $this->belongsTo(Market::class);
    }

    public function registrationKeys() {
        return $this->hasMany(RegistrationKey::class);
    }
}