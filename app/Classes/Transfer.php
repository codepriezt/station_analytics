<?php
namespace App\Classes;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Tank;
use  App\Location;
use DB;

class Transfer{



    public function transfer($data)
    {
        $sender_underground_tank = Tank::findByCode($data['sender_tank_code']);
        $reciever_underground_tank = Tank::findByCode($data['reciever_tank_code']);

        if(!$sender_underground_tank && !$reciever_underground_tank){
            return response()->json([
                'errors' => [
                    'tank' => ['Tank Not Found']
                ],
                "message" => "Invalid Tank in Location",
            ], 422);
        }

        if($sender_underground_tank->location_id != $data['sender_location_id'] && $reciever_underground_tank->location_id !=  $data['reciever_location_id'] ){
            return response()->json([
                'errors' => [
                    'Location' => ['Tank not found in this Location']
                ],
                "message" => "Tank not found in Location",
            ], 422);     
        }

        if($underground_tank->tank_type != 'App\UndergroundTank' &&  $reciever_underground_tank->tank_type != 'App\UndergroundTank'){
            return response()->json([
                'errors' => [
                    'Tank' => ['This tank is not an underground tank']
                ],
                "message" => "Tank is not an underground tank",
            ], 422);
        }

        $sender_tank = $underground_tank->tank();
        $reciever_tank = $reciever_underground_tank->tank();
            if($sender_tank->filled  == 'empty' ){
                return response()->json([
                    'errors' => [
                        'Tank' => ['This tank is empty']
                    ],
                    "message" => "This tank is empty",
                ], 422);
            }
            if($reciever_tank->filled  != 'empty' ){
                return response()->json([
                    'errors' => [
                        'Tank' => ['This tank is  not empty']
                    ],
                    "message" => "This tank is not empty",
                ], 422);
            }

        DB::beginTransaction();

        try{

            $update = $reciever_tank->update([
                'supplied_length'=> $sender_tank->supplied_length,
                'supplied_width'=> $sender_tank->supplied_width,
                'supplied_depth'=>$sender_tank->supplied_depth,
                'filled'=>$sender_tank->filled
            ]);
            
            if($update){
                $sender_tank->update([
                    'supplied_length'=> 0.00,
                    'supplied_width'=> 0.00,
                    'supplied_depth'=>0.00,
                    'filled'=>'empty'
                ]);
            }


        }catch( Exception $e){
            DB::rollback();

            return $this->Exception($e);
        }

        DB::commit();

        return true;
                    
    }



}

?>
