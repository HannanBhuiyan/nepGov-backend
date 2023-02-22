<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurvayAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function user_info()
    // {
    //     return $this->hasOne(User::class, 'id','user_id');
    // }
}
