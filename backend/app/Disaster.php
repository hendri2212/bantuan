<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    protected $fillable = [
        'disaster_name', 'date', 'location', 'information'
    ];
    public function product(){
        return $this->hasMany(Product::class, 'disaster_id', 'id');
    }
}
