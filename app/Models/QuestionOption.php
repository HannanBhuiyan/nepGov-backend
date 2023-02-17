<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function question_option()
    {
        return $this->belongsTo(PollingQuestion::class, 'question_id', 'id');
    }
}
