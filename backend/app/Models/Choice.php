<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_question_id',
        'is_correct',
        'choiceable_id',
        'choiceable_type'
    ];

    public function testQuestion() {
        return $this->belongsTo(TestQuestion::class);
    }

    public function choiceable(){
        return $this->morphTo();
    }
}
