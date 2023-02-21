<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\AAB_Bann1BS\AAB_Bann1_Main_BS;

//----------------------------------------------------------
// BANNERS CONTROLLER
//----------------------------------------------------------
// Class     : AAB_Bann1Controller
// Work with : AAB_Bann1_Main_BS
//----------------------------------------------------------
// get_AAB_Bann1_CR
// insert_AAB_Bann1_CR
// insertPro_AAB_Bann1_CR
// update_AAB_Bann1_CR
// updatePro_AAB_Bann1_CR
// deletePro_AAB_Bann1_CR
// clonePro_AAB_Bann1_CR
// updateImages_AAB_Bann1_CR
// updateImagesPro_AAB_Bann1_CR
// deleteImagesPro_AAB_Bann1_CR
// order_AAB_Bann1_CR
// orderPro_AAB_Bann1_CR
// publishPro_AAB_Bann1_CR
//----------------------------------------------------------

class AAB_Bann1Controller extends Controller
{

//----------------------------------------------------------
// BANNERS
//----------------------------------------------------------

public function __construct(AAB_Bann1_Main_BS $aab_bann1_bs)
{
   $this->middleware('auth');
   $this->aab_bann1_bs=$aab_bann1_bs;
} 


/**
 * Get banners list.
 *
 * @param string $id Identifier of the entry to look for.
 *
 * @throws banners  No entry was found for **this** identifier.
 *
 * @return banners.
 */

public function get_AAB_Bann1_CR()
{		
	try	{
	
		$banners= $this->aab_bann1_bs->get_AAB_Bann1_BS();

		if($banners->isNotEmpty()){

			$bgcolor='';
		
			return view('aab_bann1.aab_bann1_list',compact('banners','bgcolor'));

		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no banners, here you can add the banners you need.';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}
}

/**
 * Insert form banners
 *
 * @return view.
 */
public function insert_AAB_Bann1_CR()
{	
		
	return view('aab_bann1.aab_bann1_insert');
}

//----------------------------------------------------------
// POST - INSERT PRO BANNERS
//----------------------------------------------------------

public function insertPro_AAB_Bann1_CR()
{	

	try{

		$aab_bann1_id= $this->aab_bann1_bs->insertPro_AAB_Bann1_BS();	

		if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){
			
			return redirect()->route('aab-bann1-list');
		
		} 

		throw new Exception();	

	} catch (Exception $e) {

		$flash='The banner could not be inserted.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - UPDATE DATA FORM BANNERS
//----------------------------------------------------------

public function update_AAB_Bann1_CR($aab_bann1_id=null,$aab_bann1_token=null)
{	
	
	try {

			if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

				if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

					//update form
					$banners = $this->aab_bann1_bs->update_AAB_Bann1_BS($aab_bann1_id,$aab_bann1_token);

					if($banners->isNotEmpty()){
			
						return view('aab_bann1.aab_bann1_update',compact('banners'));
				
					} 	
				} 	
			}	
			
			throw new Exception();			

	} catch (Exception $e) {

		$flash='The banner does not exist.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO BANNERS
//----------------------------------------------------------

public function updatePro_AAB_Bann1_CR()
{	

	try {

		$updatepro= $this->aab_bann1_bs->updatePro_AAB_Bann1_BS();
		
		if(isset($updatepro) and $updatepro=='1'){

			return redirect()->route('aab-bann1-list');

		}	

		throw new Exception();

	} catch(Exception $e){

		$flash='The banner could not be updated.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	
	}

}

//----------------------------------------------------------
// GET - DELETE PRO BANNERS
//----------------------------------------------------------

public function deletePro_AAB_Bann1_CR($aab_bann1_id=null,$aab_bann1_token=null)
{	

	try {

		if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

			if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

				//delete pro
				$deletepro = $this->aab_bann1_bs->deletePro_AAB_Bann1_BS($aab_bann1_id,$aab_bann1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('aab-bann1-list');

				}	
			}			
		}

		throw new Exception();	

	} catch(Exception $e){		
				
		$flash='The banner could not be removed';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	
	}
}

//----------------------------------------------------------
// GET - CLONE PRO BANNERS
//----------------------------------------------------------

public function clonePro_AAB_Bann1_CR($aab_bann1_id=null,$aab_bann1_token=null)
{	

	try {

		if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

			if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

				//$aab_bann1_id was inserted
				$aab_bann1_id = $this->aab_bann1_bs->clonePro_AAB_Bann1_BS($aab_bann1_id,$aab_bann1_token);	

				if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

					return redirect()->route('aab-bann1-list');

				}
			}			
		}

		throw new Exception();

	} catch(Exception $e) {
			
		$flash='The banner could not be cloned.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}
}


//----------------------------------------------------------
// GET - UPDATE IMAGES FORM BANNERS
//----------------------------------------------------------

public function updateImages_AAB_Bann1_CR($aab_bann1_id=null,$aab_bann1_token=null)
{	
	try{

		if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

			if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

				//update form
				$banners = $this->aab_bann1_bs->update_AAB_Bann1_BS($aab_bann1_id,$aab_bann1_token);

				if($banners->isNotEmpty()){
		
					return view('aab_bann1.aab_bann1_images',compact('banners'));

				} 
			}		
		}

		throw new Exception();

	} catch(Exception $e){

		$flash='The banner does not exist.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO BANNERS
//----------------------------------------------------------

public function updateImagesPro_AAB_Bann1_CR()
{	
	try {

		//update pro
		$backarray= $this->aab_bann1_bs->updateImagesPro_AAB_Bann1_BS();

		if(isset($backarray) and $backarray['updateimagespro']=='1'){

			return redirect()->route('aab-bann1-images-update', ['aab_bann1_id' => $backarray['aab_bann1_id'],'aab_bann1_token' => $backarray['aab_bann1_token']]);
		
		}

		throw new Exception();

	} catch(Exception $e){

		$flash='Image could not be updated.';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}	
			
}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO BANNERS
//----------------------------------------------------------

public function deleteImagesPro_AAB_Bann1_CR($aab_bann1_id=null,$aab_bann1_token=null,$image_number=null)
{	

	try {

		if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

			if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

				if(isset($image_number) and is_numeric($image_number)){

					//delete image pro
					$deleteimagespro = $this->aab_bann1_bs->deleteImagesPro_AAB_Bann1_BS($aab_bann1_id,$aab_bann1_token,$image_number);

					if(isset($deleteimagespro) and $deleteimagespro=='1'){

						return redirect()->route('aab-bann1-images-update', ['aab_bann1_id' => $aab_bann1_id,'aab_bann1_token' => $aab_bann1_token]);			

					}
				}
			}		
		}

		throw new Exception();

	} catch(Exception $e){

		$flash='Image could not be deleted.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}
}

//----------------------------------------------------------
// ORDER BANNERS
//----------------------------------------------------------

public function order_AAB_Bann1_CR()
{	
	try {

		$banners= $this->aab_bann1_bs->getOrder_AAB_Bann1_BS();

		if(isset($banners) and $banners->isNotEmpty()){

			return view('aab_bann1.aab_bann1_order',compact('banners'));
		} 

		throw new Exception();

	} catch(Exception $e){

		$flash='There are no banners, here you can add the banners you need.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
//----------------------- ANGULAR ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO BANNERS
//----------------------------------------------------------

public function orderPro_AAB_Bann1_CR()
{	

	//order pro
	$backarray= $this->aab_bann1_bs->orderPro_AAB_Bann1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO BANNERS
//----------------------------------------------------------

public function publishPro_AAB_Bann1_CR()
{	

	//publish pro
	$backarray= $this->aab_bann1_bs->publishPro_AAB_Bann1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class