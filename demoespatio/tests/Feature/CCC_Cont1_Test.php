<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\ccc_cont1;

class CCC_Cont1_Test extends TestCase
{
   
    
//----------------------------------------------------------
// contact list view
//----------------------------------------------------------    

public function test_get_contacts_list(){

    $this->withoutExceptionHandling();
    
    $user = User::find(1);

    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('ccc_cont1',['ccc_cont1_name' => 'bykeLKrhsz']);


    $count = ccc_cont1::all()->count();
    $this->actingAs($user)->assertDatabaseCount('ccc_cont1',$count);
    
    $response = $this->actingAs($user)->get('/ccc-cont1-list');    
    $response->assertStatus(200); 

}

  

}
