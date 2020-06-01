<?php

namespace App\Http\Controllers\Tank;

use App\Http\Requests\Tank\volumeRequest;
use App\Http\Requests\Tank\transferRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Transfer;
use App\Tank;


class VolumeController extends Controller
{   
    public function calculate(volumeRequest $request)
    {
        $data = $request->validated();

        if($data['tank_type'] == 'reserved'){
           $location_tanks = Tank::where(['location_id' => $data['location_id'] , 'tank_type'=> 'App\ReservedTank'])->get();

           $volume = $this->volumecalculate($location_tanks);
            
        }
    }


    protected function volumecalculate($location_tanks)
    {
        $volume_array = [];

        if($location_tanks > 1){

            foreach($location_tanks as $tank){

                 $volume_array +=  $tank->volume();

            }

            return $volume_array;
            
        }else{
            $volume_array = $location_tanks->volume();
        }

        return $volume_array;
    }


    public function transfer(transferRequest $request)
    {
        $data = $request->validated();

           $transfer = (new Transfer)
                ->transfer($data);

            if($transfer)
             {
                return $this->success('Transfer successfull');
            }else{
                $this->error('Unable to transfer resource');
             }
    }
}
