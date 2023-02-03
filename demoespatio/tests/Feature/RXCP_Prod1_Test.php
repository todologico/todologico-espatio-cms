<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\rxcp_prod1;
use Tests\TestCase;


class RXCP_Prod1_Test extends TestCase
{


//----------------------------------------------------------
// GET LIST RECORDS TESTING
//----------------------------------------------------------    

public function test_get_RXCP_Prod1_CR(){

    $this->withoutExceptionHandling();

    $user = User::find(1);

    $response = $this->actingAs($user)->get('/rxcp-prod1-list'); 
    $response->assertStatus(200);   
    $response->assertSee('WR6704A');

    $count = rxcp_prod1::all()->count();

    $this->actingAs($user)->assertDatabaseCount('rxcp_prod1',$count);

    $this->actingAs($user)->assertDatabaseHas('rxcp_prod1', ['rxcp_prod1_product' => 'testing1']);
      
}

//----------------------------------------------------------
// RXCP Prod1 INSERT TEST
//----------------------------------------------------------    

public function test_insert_record_RXCP_Prod1_CR(){

    $this->withoutExceptionHandling();
  
    $user = User::find(1);  
  
    $response = $this->actingAs($user)->post('rxcp-prod1-insert-pro',[
      'rxcp_prod1_cate1_id' => 6,      
      'rxcp_prod1_product' => 'product999a',
      'rxcp_prod1_code' => '23f5',
      'rxcp_prod1_price1' => '993.45',
      'rxcp_prod1_title1' => 'lkdjghskdlfjghskdfjg',
      'rxcp_prod1_title2' => 'lkdjghskdlfjghskdfjg',
      'rxcp_prod1_title3' => 'lkdjghskdlfjghskdfjg',
      'rxcp_prod1_enable' => 1,
       ]);

       $response->assertValid();
  
    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('rxcp_prod1', ['rxcp_prod1_product' => 'product999a']);    
  
    $response->assertRedirect('/rxcp-prod1-list');
  
}

//-----------------------------------------------------------------
//RXCP UPDATE PRO TEST
//-----------------------------------------------------------------
public function test_update_RXCP_Prod1_CR(){

    $this->withoutExceptionHandling();
  
    $user = User::find(1);
    $db=  rxcp_prod1::first();
    
  
    //string to update
    $checktext=Str::random(15);
  
    $response = $this->actingAs($user)->post('/rxcp-prod1-update-pro',[
      'rxcp_prod1_id' => $db->rxcp_prod1_id,
      'rxcp_prod1_token' => $db->rxcp_prod1_token,      
      'rxcp_prod1_cate1_id' => 3,      
      'rxcp_prod1_product' => $checktext,
      'rxcp_prod1_code' => 'xxx1',
      'rxcp_prod1_price1' => '993.45',
      'rxcp_prod1_title1' => 'title1',
      'rxcp_prod1_title2' => 'title2',
      'rxcp_prod1_title3' => 'title3',
      'rxcp_prod1_enable' => 1,
       ]);
    
      $response->assertValid();
  
      //Assert that a table in the database contains records matching the given key / value query constraints
      $this->actingAs($user)->assertDatabaseHas('rxcp_prod1', ['rxcp_prod1_product' => $checktext]);
        
      $response->assertRedirect('/rxcp-prod1-list');  
  }

//-----------------------------------------------------------------
//BBP DELETE PRO TEST
//-----------------------------------------------------------------
public function test_delete_RXCP_Prod1_CR(){


    $user = User::find(1);
    $db=  rxcp_prod1::first();

    //-------------------------insert    
    $response = $this->actingAs($user)->post('rxcp-prod1-insert-pro',[
        'rxcp_prod1_cate1_id' => 3,      
        'rxcp_prod1_product' => 'product998899',
        'rxcp_prod1_code' => '23f5',
        'rxcp_prod1_price1' => '993.45',
        'rxcp_prod1_title1' => 'lkdjghskdlfjghskdfjg',
        'rxcp_prod1_title2' => 'lkdjghskdlfjghskdfjg',
        'rxcp_prod1_title3' => 'lkdjghskdlfjghskdfjg',
        'rxcp_prod1_enable' => 1,
         ]);
  
    $response->assertValid();    
    //---------------------------

    $db=  rxcp_prod1::orderby('rxcp_prod1_id', 'desc')->first();

    $count = rxcp_prod1::all()->count();

    $response = $this->actingAs($user)->get('/rxcp-prod1-delete/'.$db->rxcp_prod1_id.'/'.$db->rxcp_prod1_token);

    $response->assertValid();

    $this->actingAs($user)->assertDatabaseCount('rxcp_prod1',$count-1);

    $response->assertRedirect('/rxcp-prod1-list');
}


}