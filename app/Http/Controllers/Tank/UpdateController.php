<?php

namespace App\Http\Controllers\Tank;

use App\Http\Requests\Tank\updateRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tank;
use App\ReservedTank;
use App\UndergroundTank;


class UpdateController extends Controller
{
    public function update(updateRequest $request)
    {
            $data = $request->validated();

            $tank_code = Tank::findByCode($data['code']);

            if(!$tank_code){
                return response()->json([
                    'errors' => [
                        'tank' => ['Tank Not Found']
                    ],
                    "message" => "Invalid Tank in Location",
                ], 422);
            }

             $tank  = $tank_code->tank();
             
             $update_tank = $tank->update([
                 'height'=>$data['height'],
                 'length'=>$data['length'],
                 'width'=>$data['width'],
                 'depth'=>$data['depth']
             ]);

             if(!$update_tank)
                    {return $this->error('Unable to process REquest at the moment');}
                return $this->success('Resource Updated');
    }


    public function get(Request $request)
    {
        $this->validate($request ,[
            'type' =>'required'
        ]);

            if($request->type == 'reserved'){
                $tanks = Tank::where(['tank_type'=> 'App\ReservedTank'])->get();
            }
                $tanks = Tank::where(['tank_type' => 'App\UndergroundTank'])->get();

            return $this->success('Resources list' , compact('tanks'));
    }
}
