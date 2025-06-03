<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'index'
    ];

    public function step() {
        return $this->belongsTo(Step::class);
    }

    public function gameQuestions() {
        return $this->hasMany(GameQuestion::class);
    }

    public function gameProgresses() {
        return $this->hasMany(GameProgress::class);
    }
}
