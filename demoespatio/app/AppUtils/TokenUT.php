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
// BEAUTIFUL AND MINIMAL TOKEN GENERATION FUNCTION
// TOKEN GENERATOR - MIN 20 - MAX 500 characters.
//----------------------------------------------------------

public function generatorTokenUT(int $width = null): string
{

    $mytoken= null;

    if(isset($width) and is_numeric($width) and $width>=20 and $width<=500){        

       // working with 5 arrays        
        for ($i = 1; $i <= 5; $i++) {

            $my_bytes = random_bytes(100); 

            $source_random_string= bin2hex($my_bytes);

            $subtoken = Str::of($source_random_string)->swap(['/' => 's','=' => '_','?' => 'K','+' => 'd','$' => 'X','.' => 'U','c' => '_','6' => '_']);

            $letter = Str::of($source_random_string)->substr(0,5).date('H').Str::random(1).date('i').Str::random(2).date('s');
            
            $array_token[] = date('H').$letter.date('i').$letter.date('s').$subtoken;
            
        }   

        //random order to the array elements
       shuffle($array_token);      

        //array to string
       $mytoken=$letter.'_'.implode($array_token);  

      //subtring size
      $mytoken = Str::of($mytoken)->substr(0,$width);        
          
    }    

    return $mytoken;
    
}


//----------------------------------------------------------
}