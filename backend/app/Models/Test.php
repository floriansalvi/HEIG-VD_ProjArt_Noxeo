<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'index'
    ];

    public function step(){
        return $this->belongsTo(Step::class);
    }

    public function testQuestions() {
        return $this->hasMany(TestQuestion::class);
    }

    public function testProgresses(){
        return $this->hasMany(TestProgress::class);
    }
}
