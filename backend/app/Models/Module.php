<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_path',
        'availability_date',
        'index',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('index');
    }

    public function badges() {
        return $this->hasMany(Badge::class);
    }

    public function learningBlocks() {
        return $this->hasMany(LearningBlock::class)->orderBy('index');
    }


}
