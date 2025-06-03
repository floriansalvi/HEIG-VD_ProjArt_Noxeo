<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillBlankAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_question_id',
        'answer'
    ];

    public function answerable(){
        return $this->morphOne(GameQuestion::class, 'answerable');
    }
}
