<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'step_id',
        'attempt_date',
        'score',
        'time_bonus',
        'is_successful'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function step() {
        return $this->belongsTo(Step::class);
    }
}