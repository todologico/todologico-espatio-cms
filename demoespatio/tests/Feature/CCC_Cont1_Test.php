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
//GET LIST CCC PRO TEST
//----------------------------------------------------------    

public function test_get_contacts_list(){

    $this->withoutExceptionHandling();
    
    $user = User::find(1);

    //Assert that a table in the database contains records matching the given key / value query constraints
    //$this->actingAs($user)->assertDatabaseHas('ccc_cont1',['ccc_cont1_name' => '4LkFmmXb2t']);


    $count = ccc_cont1::all()->count();
    $this->actingAs($user)->assertDatabaseCount('ccc_cont1',$count);
    
    $response = $this->actingAs($user)->get('/ccc-cont1-list');    
    $response->assertStatus(200); 

}


//-----------------------------------------------------------------
//DELETE CCC PRO TEST
//-----------------------------------------------------------------
public function test_delete_CCC_Cont1_CR(){

    $user = User::find(1);
    
    $db=  ccc_cont1::orderby('ccc_cont1_id', 'desc')->first();

    $count = ccc_cont1::all()->count();

    $response = $this->actingAs($user)->get('/ccc-cont1-delete/'.$db->ccc_cont1_id.'/'.$db->ccc_cont1_token);

    $response->assertValid();

    $this->actingAs($user)->assertDatabaseCount('ccc_cont1',$count-1);

    $response->assertRedirect('/ccc-cont1-list');

}

  

}
