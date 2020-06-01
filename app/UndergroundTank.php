<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UndergroundTank extends Model
{

     //creating fillables..[1.05 , 2.40 , 5.8 , 5.3 , 'empty']
     protected $fillable = [
        'height' , 'width' ,'length' , 'depth' , 'filled'
    ];


    //getting volume
    public function volume()
    {

          return $this->supplied_depth * $this->supplied_width * $this->supplied_length;

    }

    //creating instance
    public static function createNew($data)
    {
            return self::create([
                'height'=>$data['height'],
                'width'=>$data['width'],
                'length'=> $data['length'],
                'depth'=> $data['depth'],
                'filled'=>'empty'
            ]);
    }
}
