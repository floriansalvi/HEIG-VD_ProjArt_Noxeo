<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_question_id',
        'content',
        'index'
    ];

    public function answerable(){
        return $this->morphOne(GameQuestion::class, 'answerable');
    }
}
