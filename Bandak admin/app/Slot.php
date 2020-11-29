<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    protected $fillable = [
        'category_id','datee','slot','isBooked'
    ];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at'  => 'date:Y-m-d',
    ];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
}
