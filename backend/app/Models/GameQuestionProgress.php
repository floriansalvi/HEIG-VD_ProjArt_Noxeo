<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameQuestionProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'game_question_id',
        'is_successful',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gameProgress() {
        return $this->belongsTo(GameProgress::class);
    }

    public function gameQuestion() {
        return $this->belongsTo(GameQuestion::class);
    }
}
