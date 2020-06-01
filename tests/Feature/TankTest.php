<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Tank;
use App\UndergroundTank;
use App\ReservedTank;

class TankTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_to_validate_code()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['code'=> '']));
        
       
        $response->assertSessionHasErrors('code');
        
        $this->assertCount(0 , ReservedTank::all());
        
        $this->assertCount(0 , UndergroundTank::all());

        $this->assertCount(0 , Tank::all());
        
      
    }

    public function test_to_validate_type()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['tank_type'=> '']));
        
       
        $response->assertSessionHasErrors('tank_type');
        
        $this->assertCount(0 , Tank::all());
        
      
    }

    public function test_to_validate_tank_dimension()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['tank_dimension'=> '']));
        
       
        $response->assertSessionHasErrors('tank_dimension');
        
        $this->assertCount(0 , Tank::all());
        
      
    }

    public function test_to_validate_location_id()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['location_id'=> '']));
        
       
        $response->assertSessionHasErrors('location_id');
        
        $this->assertCount(0 , Tank::all());
        
      
    }


    public function test_to_validate_height()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['height'=> '']));
        
       
        $response->assertSessionHasErrors('height');
        
        $this->assertCount(0 , Tank::all());
        
      
    }


    public function test_to_validate_length()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['length'=> '']));
        
       
        $response->assertSessionHasErrors('length');
        
        $this->assertCount(0 , Tank::all());
        
      
    }


    public function test_to_validate_width()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['width'=> '']));
        
       
        $response->assertSessionHasErrors('width');
        
        $this->assertCount(0 , Tank::all());
        
      
    }



    public function test_to_validate_depth()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/tank/create', array_merge($this->data() , ['depth'=> '']));
        
       
        $response->assertSessionHasErrors('width');
        
        $this->assertCount(0 , Tank::all());
        
      
    }



    private function data()
    {
        return [
            'code'=>'WAT014',
            'tank_type'=>'reserved',
            'tank_dimension'=>'rectangular',
            'location_id'=>2,
            'height'=>7.5,
            'length'=>20.0,
            'width'=>5.5,
            'depth'=>34.3
        ];
    }


    
}
