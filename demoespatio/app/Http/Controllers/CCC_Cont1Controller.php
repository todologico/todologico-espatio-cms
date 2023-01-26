<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\CCC_Cont1BS\CCC_Cont1_Main_BS;


//----------------------------------------------------------
// CONTACT CONTROLLER
//----------------------------------------------------------
// Class   : CCC_Cont1Controller
// Used by : CCC_Cont1MainBS
//----------------------------------------------------------
// get_CCC_Cont1_CR
//----------------------------------------------------------

class CCC_Cont1Controller extends Controller
{

//----------------------------------------------------------
// CONTACT
//----------------------------------------------------------

public function __construct(CCC_Cont1_Main_BS $ccc_cont1bs)
{
   $this->middleware('auth');
   $this->ccc_cont1bs=$ccc_cont1bs;
} 

//----------------------------------------------------------
// GET CONTACT
//----------------------------------------------------------

public function get_CCC_Cont1_CR()
{	

	

	try {

		$contacts= $this->ccc_cont1bs->get_CCC_Cont1_BS();

		if($contacts->isNotEmpty()){

			$bgcolor=''; $bgcolor1='';
		
			return view('ccc_cont1.ccc_cont1_list',compact('contacts','bgcolor','bgcolor1'));

		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no contacts';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// GET SEARCH CONTACT
//----------------------------------------------------------

public function getSearch_CCC_Cont1_CR()
{	

	try {

		$contacts= $this->ccc_cont1bs->getSearch_CCC_Prod1_BS();

		if($contacts->isNotEmpty()){

			$bgcolor=''; $bgcolor1='';
		
			return view('ccc_cont1.ccc_cont1_list',compact('contacts','bgcolor','bgcolor1'));

		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no contacts';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}
}

//----------------------------------------------------------
// GET - DELETE PRO CONTACT
//----------------------------------------------------------

public function deletePro_CCC_Cont1_CR($ccc_cont1_id=null,$ccc_cont1_token=null)
{	
	try {

		if(isset($ccc_cont1_id) and is_numeric($ccc_cont1_id)){

			if(isset($ccc_cont1_token) and is_string($ccc_cont1_token)){

				$deletepro = $this->ccc_cont1bs->deletePro_CCC_Cont1_BS($ccc_cont1_id,$ccc_cont1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('ccc-cont1-list');
				}	
			}
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The contact could not be deleted';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}
//----------------------------------------------------------
} // end class