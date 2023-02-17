<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalOption extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function option_reviews(){
        return $this->hasMany(NormalReview::class, 'option_id','id'); 
    }
    public function category(){
        return $this->belongsTo(PollingCategory::class, 'category_id'); 
    }


}
