<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;


//----------------------------------------------------------
// ERROR MESSAGE CONTROLLER
//----------------------------------------------------------
// Class     : ErrorsMessageController
// Work with : all the controllers
//----------------------------------------------------------
// show_Error_View_CR


class ErrorMessageController extends Controller
{

//----------------------------------------------------------
// BANNERS
//----------------------------------------------------------

public function __construct()
{
   $this->middleware('auth');
} 

//----------------------------------------------------------
// SHOW ERROR VIEW
//----------------------------------------------------------

public function show_Error_View_CR()
{	
				
	return view('errors.show_error_message');

		
}

//----------------------------------------------------------
} // end class