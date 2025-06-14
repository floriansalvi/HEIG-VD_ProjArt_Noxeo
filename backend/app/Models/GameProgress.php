<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'score',
        'last_play',
        'is_complete'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function gameQuestionProgresses() {
        return $this->hasMany(GameQuestionProgress::class);
    }
}