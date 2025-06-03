<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTotalScore extends Model
{
    public $timestamps = false;

    protected $table = 'user_total_scores';

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';

    public function getConnectionName(){
        return config('database.default');
    }
}
