<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use App\AppBusiness\CCC_Cont1BS\CCC_Cont1_Main_BS;


//----------------------------------------------------------
// PRODUCTS CONTROLLER
//----------------------------------------------------------
// Class   : CCC_Cont1Controller
// Used by : CCC_Cont1MainBS
//----------------------------------------------------------
// get_CCC_Cont1_CR
//----------------------------------------------------------

class CCC_Cont1Controller extends Controller
{

//----------------------------------------------------------
// PRODUCTS
//----------------------------------------------------------

public function __construct(CCC_Cont1_Main_BS $ccc_cont1bs)
{
   $this->middleware('auth');
   $this->ccc_cont1bs=$ccc_cont1bs;
} 

//----------------------------------------------------------
// GET PRODUCTS
//----------------------------------------------------------

public function get_CCC_Cont1_CR()
{	

	$contacts= $this->ccc_cont1bs->get_CCC_Cont1_BS();

	if($contacts->isNotEmpty()){
	
		return view('ccc_cont1.ccc_cont1_list',compact('contacts'));

	} 

	//--------------------------------------------------------------------------
	//error message
	$flash='No hay contactos';			
	return redirect()->route('ccc-cont1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------

}

//----------------------------------------------------------
// GET SEARCH PRODUCTS
//----------------------------------------------------------

public function getSearch_CCC_Cont1_CR()
{	

	$contacts= $this->ccc_cont1bs->getSearch_CCC_Prod1_BS();

	if($contacts->isNotEmpty()){
	
		return view('ccc_cont1.ccc_cont1_list',compact('contacts'));

	} 

	//--------------------------------------------------------------------------
	//error message
	$flash='No hay contactos en la búsqueda';			
	return redirect()->route('ccc-cont1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------
}

//----------------------------------------------------------
// GET - DELETE PRO PRODUCTS
//----------------------------------------------------------

public function deletePro_CCC_Cont1_CR($ccc_cont1_id=null,$ccc_cont1_token=null)
{	

   if(isset($ccc_cont1_id) and is_numeric($ccc_cont1_id)){

      if(isset($ccc_cont1_token) and is_string($ccc_cont1_token)){

			//delete pro
			$deletepro = $this->ccc_cont1bs->deletePro_CCC_Cont1_BS($ccc_cont1_id,$ccc_cont1_token);

			if(isset($deletepro) and $deletepro=='1'){

	   		return redirect()->route('ccc-cont1-list');

			}	
		}
	
	}

}
//----------------------------------------------------------
} // end class