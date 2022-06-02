<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function disaster(){
        return $this->belongsTo(Disaster::class, 'disaster_id', 'id');
    }
}
