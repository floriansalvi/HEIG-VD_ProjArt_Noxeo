<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'vid_path',
        'description'
    ];

    public function learningBlock(){
        return $this->morphOne(LearningBlock::class, 'blockable');
    }
}
