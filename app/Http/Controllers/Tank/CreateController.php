<?php

namespace App\Http\Controllers\Tank;

use App\Http\Requests\Tank\createRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tank;
use App\ReservedTank;
use App\UndergroundTank;
use DB;

class CreateController extends Controller
{
    public function create(createRequest $request)
    {
            $data = $request->validated();

            DB::beginTransaction();

            try{

                if($data['tank_type'] == 'reserved'){

                    
                    $new_tank = ReservedTank::createNew($data);
                       
                    if($new_tank){
                        $type = 'App\ReservedTank';
                        $tank = Tank::createNew($data ,$new_tank , $type);
                    }

                }else{
                    
                    $new_tank = UndergroundTank::createNew($data);

                    if($new_tank){
                        $type = 'App\UndergroundTank';
                       $tank = Tank::createNew($data , $new_tank , $type);      
                    }   
                }

            }catch(Exception $e){
                DB::rollback();
               return $this->Exception($e);
            }

            DB::commit();

            return $this->success('Resource created' , compact('tank'));
    }
}
