<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    public function product(){
        return $this->hasMany(Product::class, 'disaster_id', 'id');
    }
}
