<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function poll_sub_cat(){
        return $this->hasMany(PollingSubCategory::class, 'category_id','id'); 
    }

}
