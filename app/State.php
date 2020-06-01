<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name' , 'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(App::Country);
    }
}
