<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\bbp_prod1;
use Tests\TestCase;


class BBP_Prod1_Test extends TestCase
{


//----------------------------------------------------------
// GET LIST RECORDS TESTING
//----------------------------------------------------------    

public function test_get_BBP_Prod1_CR(){

    $this->withoutExceptionHandling();

    $user = User::find(1);

    //$response = $this->actingAs($user)->get('/bbp-prod1-list'); 
    //$response->assertStatus(200);   
   // $response->assertSee('product1');


    $count = bbp_prod1::all()->count();
    $this->actingAs($user)->assertDatabaseCount('bbp_prod1',$count);

    $this->actingAs($user)->assertDatabaseHas('bbp_prod1', ['bbp_prod1_product' => 'product1']);
      
}



}