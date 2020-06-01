<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{

    //creating a tank ..eg['WAT01' , 'App\ReservedTank' , 'rectangular' ,1, 2]
    protected $fillable = [
        'code' , 'tank_type' , 'tank_dimension' , 'tank_id' , 'location_id'
    ];

    public static function findByCode($code)
    {
         return self::where('code' , $code)->first();
    }


    //morph to tank_type
    public function tank()
    {
        return $this->morphTo();
    }

    //relationship
    public function location()
    {
        return $this->belongsTo(App::Location);
    }


    //getting volume of tank
    public function volume()
    {
        return $this->tank()->volume();
    }


    public function oneDay()
    {
        return date('Y-m-d', strtotime('24hrs'));
    }



    //creating tank instance after creating the type
    public static function createNew($data , $new_tank  , $type)
    {
            return self::create([
                'code'=> $data['code'],
                'tank_type'=>$type,
                'tank_dimension'=> $data['tank_dimension'],
                'location_id'=>$data['location_id'],
                'tank_id'=>$new_tank->id,
            ]);
    }
}
