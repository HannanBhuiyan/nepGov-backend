<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalReview extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function normal_options(){
        return $this->hasMany(NormalOption::class, 'topic_id','id'); 
    }

}
