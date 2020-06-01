<?php

namespace App\Http\Controllers\Location;

use App\Http\Requests\Location\updateRequest;
use App\Http\Requests\Location\createRequest;
use App\Http\Requests\Location\deleteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Location;
use DB;

class IndexController extends Controller
{
    public function create(createRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try{

           $location = Location::create([
                'address'=>$data['address'],
                'state_id'=>$data['state_id'],
                'country_id'=>$data['country_id']
            ]);

        }catch(Exception $e){
            DB::rollback();
           return $this->Exception($e);
        }

        DB::commit();

       return $this->success('location Created' , compact('location'));
    }


    public function update(updateRequest $request)
    {
        $data = $request->validated();

            $location = Location::where('id' , $data['id'])->first();

            DB::beginTransaction();

            try{

                if($location){
                
                    $location->update([
                        'address'=>$data['address'],
                        'state_id'=>$data['state_id'],
                        'country_id'=>$data['country_id']
                    ]);
                }else{

                    return $this->error('Unable to Update resource');
                }

            }catch(Exception $e){

                DB::rollback();

               return  $this->Exception($e);
            }

            DB::commit();

            return $this->success('Resource updated');
    }


    public function delete(deleteRequest $request)
    {
        $data = $request->validated();

        $location = Location::where('id' , $data['id'])->delete();

        if(!$location){
            return $this->error('Unable to process request , please try again later');
        }

        return $this->success('Resource deleted successfully');
    }


    public function get()
    {
        $locations = Location::all();

        return $this->success('Resource list' , compact('locations'));
    }
    
}
