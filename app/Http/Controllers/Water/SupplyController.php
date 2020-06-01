<?php

namespace App\Http\Controllers\Water;

use App\Http\Requests\waterSupplyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Supply;
use App\Location;
use App\Tank;

class SupplyController extends Controller
{
    
    public function supplyRectangularTank(waterSupplyRequest $request)
    {
            $data = $request->validated();

           
            $supply = (new Supply)
                    ->supply($data);

            if($supply){
                return $this->success('Water Supply successfully');
            }else{
                return $this->error('Unable to process request');
            }
        
    }
}
