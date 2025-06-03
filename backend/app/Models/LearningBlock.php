<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'index',
        'module_id',
        'blockable_id',
        'blockable_type',
    ];

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function blockable() {
        return $this->morphTo();
    }
}
