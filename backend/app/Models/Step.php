<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'index',
        'module_id',
        'type',
        'next_step',
        'max_time'
    ];

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function nextStep() {
        return $this->belongsTo(Step::class, 'next_step');
    }

    public function previousStep() {
        return $this->hasMany(Step::class, 'next_step');
    }

    public function test() {
        return $this->hasOne(Test::class);
    }

    public function game() {
        return $this->hasOne(Game::class);
    }
}
