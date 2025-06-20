<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'index',
        'content',
        'points_awarded',
        'type'
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function answerable() {
        return $this->morphTo();
    }

    public function gameQuestionProgresses() {
        return $this->hasMany(GameQuestionProgress::class);
    }
}