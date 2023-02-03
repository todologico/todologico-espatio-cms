<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\bbp_prod1;
use Tests\TestCase;


class BBP_Prod1_Test extends TestCase
{


//----------------------------------------------------------
// RXCP GET LIST RECORDS TESTING
//----------------------------------------------------------    

public function test_get_List_BBP_Prod1_CR(){

    $this->withoutExceptionHandling();

    $user = User::find(1);

    $response = $this->actingAs($user)->get('/bbp-prod1-list'); 
    $response->assertStatus(200);   
    $response->assertSee('product1');

    $count = bbp_prod1::all()->count();
    $this->actingAs($user)->assertDatabaseCount('bbp_prod1',$count);

    $this->actingAs($user)->assertDatabaseHas('bbp_prod1', ['bbp_prod1_product' => 'product1']);
      
}

//----------------------------------------------------------
// RXCP INSERT TEST
//----------------------------------------------------------    

public function test_insert_record_BBP_Prod1_CR(){

    $this->withoutExceptionHandling();
  
    $user = User::find(1);    
  
    $response = $this->actingAs($user)->post('bbp-prod1-insert-pro',[
      'bbp_prod1_product' => 'product123',
      'bbp_prod1_code' => '23f5',
      'bbp_prod1_price1' => '123.45',
      'bbp_prod1_title1' => 'lkdjghskdlfjghskdfjg',
      'bbp_prod1_title2' => 'lkdjghskdlfjghskdfjg',
      'bbp_prod1_title3' => 'lkdjghskdlfjghskdfjg',
      'bbp_prod1_enable' => 1,
       ]);

       $response->assertValid();
  
    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('bbp_prod1', ['bbp_prod1_product' => 'product123']);    
  
    $response->assertRedirect('/bbp-prod1-list');
  
  }

//-----------------------------------------------------------------
//RXCP UPDATE PRO TEST
//-----------------------------------------------------------------
public function test_update_BBP_Prod1_CR(){

    $this->withoutExceptionHandling();
  
    $user = User::find(1);
    $db=  bbp_prod1::first();
  
    //string to update
    $checktext=Str::random(15);
  
    $response = $this->actingAs($user)->post('/bbp-prod1-update-pro',[
      'bbp_prod1_id' => $db->bbp_prod1_id,
      'bbp_prod1_token' => $db->bbp_prod1_token,      
      'bbp_prod1_product' => $checktext,
      'bbp_prod1_code' => '23f5',
      'bbp_prod1_price1' => '993.45',
      'bbp_prod1_title1' => 'title1',
      'bbp_prod1_title2' => 'title2',
      'bbp_prod1_title3' => 'title3',
      'bbp_prod1_enable' => 1,
       ]);
    
      $response->assertValid();
  
      //Assert that a table in the database contains records matching the given key / value query constraints
      $this->actingAs($user)->assertDatabaseHas('bbp_prod1', ['bbp_prod1_product' => $checktext]);
        
      $response->assertRedirect('/bbp-prod1-list');
  
  }
  
//-----------------------------------------------------------------
//RXCP DELETE PRO TEST
//-----------------------------------------------------------------
public function test_delete_BBP_Prod1_CR(){

    $user = User::find(1);
    $db=  bbp_prod1::orderby('bbp_prod1_id', 'desc')->first();

    $count = bbp_prod1::all()->count();

    $response = $this->actingAs($user)->get('/bbp-prod1-delete/'.$db->bbp_prod1_id.'/'.$db->bbp_prod1_token);

    $response->assertValid();

    $this->actingAs($user)->assertDatabaseCount('bbp_prod1',$count-1);

    $response->assertRedirect('/bbp-prod1-list');
}

}