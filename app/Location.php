<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    //creating fillables....['address12' , 1 , 2]
    protected $fillable = [
        'address' , 'state_id' , 'country_id'
    ];


    public function tanks()
    {
        return $this->hasMany(App::Tank);
    }
}
