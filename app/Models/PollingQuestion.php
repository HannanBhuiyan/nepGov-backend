<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingQuestion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sub_category()
    {
        return $this->belongsTo(PollingSubCategory::class, 'sub_category_id','id');
    }

    public function poll_options(){
        return $this->hasMany(QuestionOption::class, 'question_id','id'); 
    }
}
