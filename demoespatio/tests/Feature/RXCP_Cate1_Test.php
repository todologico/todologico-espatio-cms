<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\rxcp_cate1;
use Tests\TestCase;


class RXCP_Cate1_Test extends TestCase
{


//----------------------------------------------------------
// GET LIST RECORDS TESTING
//----------------------------------------------------------    

public function test_get_RXCP_Cate1_CR(){

    $this->withoutExceptionHandling();

    $user = User::find(1);

    $response = $this->actingAs($user)->get('/rxcp-cate1-list'); 
    $response->assertStatus(200);   
    $response->assertSee('category 1');

    $count = rxcp_cate1::all()->count();

    $this->actingAs($user)->assertDatabaseCount('rxcp_cate1',$count);

    $this->actingAs($user)->assertDatabaseHas('rxcp_cate1', ['rxcp_cate1_category' => 'category 1']);
      
}

//----------------------------------------------------------
// RXCP CATE1 INSERT TEST
//----------------------------------------------------------    

public function test_insert_record_RXCP_Cate1_CR(){

    $this->withoutExceptionHandling();
  
    $user = User::find(1);  
  
    $response = $this->actingAs($user)->post('rxcp-cate1-insert-pro',[
      'rxcp_cate1_category' => 'category999',
      'rxcp_cate1_title1' => 'lkdjghskdlfjghskdfjg',
      'rxcp_cate1_title2' => 'lkdjghskdlfjghskdfjg',
      'rxcp_cate1_enable' => 1,
       ]);

       $response->assertValid();
  
    //Assert that a table in the database contains records matching the given key / value query constraints
    $this->actingAs($user)->assertDatabaseHas('rxcp_cate1', ['rxcp_cate1_category' => 'category999']);    
  
    $response->assertRedirect('/rxcp-cate1-list');
  
}

//-----------------------------------------------------------------
//RXCP UPDATE PRO TEST
//-----------------------------------------------------------------
public function test_update_RXCP_Cate1_CR(){

    $this->withoutExceptionHandling();
  
    $user = User::find(1);
    $db=  rxcp_cate1::first();
  
    //string to update
    $checktext=Str::random(15);
  
    $response = $this->actingAs($user)->post('/rxcp-cate1-update-pro',[
      'rxcp_cate1_id' => $db->rxcp_cate1_id,
      'rxcp_cate1_token' => $db->rxcp_cate1_token,      
      'rxcp_cate1_category' => $checktext,
      'rxcp_cate1_title1' => 'title1',
      'rxcp_cate1_title2' => 'title2',
      'rxcp_cate1_enable' => 1,
       ]);
    
      $response->assertValid();
  
      //Assert that a table in the database contains records matching the given key / value query constraints
      $this->actingAs($user)->assertDatabaseHas('rxcp_cate1', ['rxcp_cate1_category' => $checktext]);
        
      $response->assertRedirect('/rxcp-cate1-list');
  
  }

//-----------------------------------------------------------------
//BBP DELETE PRO TEST
//-----------------------------------------------------------------
// public function test_delete_RXCP_Cate1_CR(){


//     $user = User::find(1);
//     $db=  rxcp_cate1::first();

//     //-------------------------insert    
//     $response = $this->actingAs($user)->post('rxcp-cate1-insert-pro',[
//         'rxcp_cate1_category' => 'category999',
//         'rxcp_cate1_title1' => 'lkdjghskdlfjghskdfjg',
//         'rxcp_cate1_title2' => 'lkdjghskdlfjghskdfjg',
//         'rxcp_cate1_enable' => 1,
//          ]);
  
//     $response->assertValid();    
//     //---------------------------

//     $db=  rxcp_cate1::orderby('rxcp_cate1_id', 'desc')->first();


//     $count = rxcp_cate1::all()->count();

//     $response = $this->actingAs($user)->get('/rxcp-cate1-delete/'.$db->rxcp_cate1_id.'/'.$db->rxcp_cate1_token);

//     $response->assertValid();

//     $this->actingAs($user)->assertDatabaseCount('rxcp_cate1',$count-1);

//     $response->assertRedirect('/rxcp-cate1-list');
// }


}