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
    
    //$user = User::factory()->create();

    $user = User::find(1);
    
    $response = $this->actingAs($user)->get('/ccc-cont1-list');
    
    $response->assertStatus(200); 

}

  

}
