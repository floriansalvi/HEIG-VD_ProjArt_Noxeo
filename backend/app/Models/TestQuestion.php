<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'content',
        'points_awarded',
        'next_question'
    ];

    public function nextQuestion() {
        return $this->belongsTo(TestQuestion::class, 'next_question');
    }

    public function step() {
        return $this->belongsTo(Step::class);
    }

    public function choices() {
        return $this->hasMany(Choice::class);
    }
}
