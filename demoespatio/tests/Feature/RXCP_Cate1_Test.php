<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

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



}