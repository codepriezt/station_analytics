<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Location;


class LocationTest extends TestCase
{

    use RefreshDatabase;
    

        public function validate_request_address()
        {
            $this->withoutExceptionHandling();

            $response = $this->post('/api/location/create', array_merge($this->data() , ['address'=> '']));
            
           
            $response->assertSessionHasErrors('address');
            
            $this->assertCount(0 , Location::all());
        }

        public function validate_request_state()
        {
            $this->withoutExceptionHandling();

            $response = $this->post('/api/location/create', array_merge($this->data() , ['state_id'=> '']));
            
           
            $response->assertSessionHasErrors('state_id');
            
            $this->assertCount(0 , Location::all());
        }

        public function validate_request_country()
        {
            $this->withoutExceptionHandling();

            $response = $this->post('/api/location/create', array_merge($this->data() , ['country_id'=> '']));
            
           
            $response->assertSessionHasErrors('country_id');
            
            $this->assertCount(0 , Location::all());
        }


        public function validate_request_location()
        {
            
            $response = $this->post('/api/location/delete', array_merge($this->data() , ['location_id'=> '']));
            
           
            $response->assertSessionHasErrors('location_id');
            
            $this->assertCount(0 , Location::all());
        }




    private function data()
    {
        return [
            'address' => 'location24 aes street',
            'state_id' =>2,
            'country_id' =>3,
            'location_id'=>2
        ];
    }


}

?>