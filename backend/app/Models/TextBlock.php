<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    public function learningBlock(){
        return $this->morphOne(LearningBlock::class, 'blockable');
    }
}
