<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\aab_bann1;
use Tests\TestCase;

use \App\AppQuerys\AAB_Bann1_Data_QY;

class AAB_Bann1_Test extends TestCase
{


//----------------------------------------------------------
// GET LIST RECORDS TESTING
//----------------------------------------------------------    

public function test_get_AAB_Bann1_CR(){

    $this->withoutExceptionHandling();

    $user = User::find(1);

    $response = $this->actingAs($user)->get('/aab-bann1-list'); 

    $response->assertStatus(200);   
    $response->assertSee('banner1');
    $count = aab_bann1::all()->count();

    //Assert that a table in the database contains the given number of records
    $this->actingAs($user)->assertDatabaseCount('aab_bann1',$count);

    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('aab_bann1', ['aab_bann1_banner' => 'banner1']);
      
}

//----------------------------------------------------------
// INSERT TEST
//----------------------------------------------------------    

public function test_insert_AAB_Bann1_CR(){

  $this->withoutExceptionHandling();

  $user = User::find(1);

  $response = $this->actingAs($user)->post('aab-bann1-insert-pro',[
    'aab_bann1_banner' => 'european cup1',
    'aab_bann1_title1' => 'title1',
    'aab_bann1_title2' => 'title2',
    'aab_bann1_title3' => 'title3',
    'aab_bann1_enable' => 1,
     ]);
  
  $response->assertValid();

    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('aab_bann1', ['aab_bann1_banner' => 'european cup1']);
      

  $response->assertRedirect('/aab-bann1-list');

}

//-----------------------------------------------------------------
//UPDATE PRO TEST
//-----------------------------------------------------------------
public function test_update_AAB_Bann1_CR(){

  $this->withoutExceptionHandling();

  $user = User::find(1);
  $db=  aab_bann1::first();

  $response = $this->actingAs($user)->post('/aab-bann1-update-pro',[
    'aab_bann1_id' => $db->aab_bann1_id,
    'aab_bann1_token' => $db->aab_bann1_token,
    'aab_bann1_banner' => 'successful update',
    'aab_bann1_title1' => 'title1',
    'aab_bann1_title2' => 'title2',
    'aab_bann1_title3' => 'title3',
    'aab_bann1_enable' => 1,
     ]);
  
    $response->assertValid();

    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('aab_bann1', ['aab_bann1_banner' => 'successful update']);
      
    $response->assertRedirect('/aab-bann1-list');

}

//-----------------------------------------------------------------
//DELETE PRO TEST
//-----------------------------------------------------------------
public function test_delete_AAB_Bann1_CR(){

    $user = User::find(1);
    $db=  aab_bann1::orderby('aab_bann1_id', 'desc')->first();

    $count = aab_bann1::all()->count();

    $response = $this->actingAs($user)->get('/aab-bann1-delete/'.$db->aab_bann1_id.'/'.$db->aab_bann1_token);

    $response->assertValid();

    $this->actingAs($user)->assertDatabaseCount('aab_bann1',$count-1);

    $response->assertRedirect('/aab-bann1-list');

}


}