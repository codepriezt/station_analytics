<?php

namespace App\Classes;



use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Location;
use App\Tank;
use App\ReservedTank;
use App\UndergroundTank;



class Suppy{


    public function supply($data){

            $tank = Tank::findByCode($data['code']);

            if(!$tank){
                return response()->json([
                    'errors'=>[
                        'tank'=>['Tank does not exist ']
                    ],
                    'message'=> 'Invalid Tank Code'
                ] , 442);
            }

    if($tank->location_id == $data['location_id']){
        
            $reserved_tank = $tank->tank();

        if(!$reserved_tank){
            return response()->json([
                'errors' => [
                    'tank' => ['Tank Not Found']
                ],
                "message" => "Invalid Tank in Location",
            ], 422);
        }else{

            $calculating_filled = $reserved_tank->length - int($data['supplied_length']);
            $status = $calculating_filled == 0 ? 'full' : 'half';
                
                $update = $reserved_tank->update([
                    'supplied_length'=>$data['supplied_length'],
                    'supplied_width'=>$data['supplied_width'],
                    'supplied_depth'=>$data['supplied_depth'],
                    'filled'=>$status
                ]);

        }

        return true;
    }else{

        return false;
    }


    }
}


?>