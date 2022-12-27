<?php

namespace App\AppUtils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//----------------------------------------------------------
// TOKEN GENERATOR
//----------------------------------------------------------

class TokenUT extends Controller
{

//----------------------------------------------------------
// CONSTRUCTOR
//----------------------------------------------------------

public function __construct(){}

//----------------------------------------------------------
// TOKEN GENERATOR
//----------------------------------------------------------

public function generatorTokenUT($width)
{

    $mytoken= null;

    if(isset($width) and is_numeric($width)){

        if($width>0){
    
            $chain1=Str::random($width); $chain2=Str::random(35); $chain3=Str::random(30); 

            $hash1= password_hash($chain1, PASSWORD_DEFAULT);
            $hash2= password_hash($chain2, PASSWORD_DEFAULT);
            $hash3= password_hash($chain3, PASSWORD_DEFAULT);

            //hashing token with bcrypt
            $mytoken=substr($hash1.$hash2.Hash::make($hash3),0,$width);    
            
            //deleting strange characters unsuported by url browser system
            $mytoken=str_replace("/","_",$mytoken); //urls are broken by /
            $mytoken=str_replace("$","2n",$mytoken); // urls are broken by $
            $mytoken=str_replace(".","7k",$mytoken); // urls are broken by $

            //add time and user id
            $mytoken=$mytoken.date('Y').date('m').date('d').date('H').date('i').date('s').'_'.Auth::id(); 

            $width=$width-1;
            $from=($width*-1);
            $mytoken=substr($mytoken,$from,$width);  

            $mytoken='A'.$mytoken;

        }    
    }    

    return $mytoken;
    
}


//----------------------------------------------------------
}