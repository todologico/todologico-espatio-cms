<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Cate1BS\ZGFCP_Cate1_Main_BS;


//----------------------------------------------------------
// ZGFCP_Cate1 CONTROLLER
//----------------------------------------------------------
// Class   : ZGFCP_Cate1Controller
// Used by : ZGFCP_Cate1_Main_BS
//----------------------------------------------------------
// get_ZGFCP_Cate1_CR
// insert_ZGFCP_Cate1_CR
// insertPro_ZGFCP_Cate1_CR
// update_ZGFCP_Cate1_CR
// updatePro_ZGFCP_Cate1_CR
// deletePro_ZGFCP_Cate1_CR
// clonePro_ZGFCP_Cate1_CR
// updateImages_ZGFCP_Cate1_CR
// updateImagesPro_ZGFCP_Cate1_CR
// deleteImagesPro_ZGFCP_Cate1_CR
// order_ZGFCP_Cate1_CR
// orderPro_ZGFCP_Cate1_CR
// publishPro_ZGFCP_Cate1_CR
//----------------------------------------------------------

class ZGFCP_Cate1Controller extends Controller
{

//----------------------------------------------------------
// CATEGORIES
//----------------------------------------------------------

public function __construct(ZGFCP_Cate1_Main_BS $zgfcp_cate1bs)
{
   $this->middleware('auth');
   $this->zgfcp_cate1bs=$zgfcp_cate1bs;
} 

//----------------------------------------------------------
// GET CATEGORIES
//----------------------------------------------------------

public function get_ZGFCP_Cate1_CR()
{	

	try {

		$backarray= $this->zgfcp_cate1bs->get_ZGFCP_Cate1_BS();

		$categories=$backarray['categories'];

		$countprod1xcate1=$backarray['countprod1xcate1'];

		if($categories->isNotEmpty()){
		
			return view('zgfcp_cate1.zgfcp_cate1_list',compact('categories','countprod1xcate1'));

		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no categories';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - INSERT FORM CATEGORIES
//----------------------------------------------------------

public function insert_ZGFCP_Cate1_CR()
{	

	$families= $this->zgfcp_cate1bs->insert_ZGFCP_Cate1_BS();
		
	return view('zgfcp_cate1.zgfcp_cate1_insert',compact('families'));
}

//----------------------------------------------------------
// POST - INSERT PRO CATEGORIES
//----------------------------------------------------------

public function insertPro_ZGFCP_Cate1_CR()
{	

	try {

		$zgfcp_cate1_id= $this->zgfcp_cate1bs->insertPro_ZGFCP_Cate1_BS();	

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){
			
			return redirect()->route('zgfcp-cate1-list');
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The category could not be created.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - UPDATE DATA FORM CATEGORIES
//----------------------------------------------------------

public function update_ZGFCP_Cate1_CR($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{	
	try {

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

			if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

				$backarray = $this->zgfcp_cate1bs->update_ZGFCP_Cate1_BS($zgfcp_cate1_id,$zgfcp_cate1_token);

				if($backarray['categories']->isNotEmpty()){
				
					if($backarray['families']->isNotEmpty()){

						$categories=$backarray['categories'];
						$families=$backarray['families'];
		
						return view('zgfcp_cate1.zgfcp_cate1_update',compact('categories','families'));
					}
				} 
			}
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The category does not exist.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO CATEGORIES
//----------------------------------------------------------

public function updatePro_ZGFCP_Cate1_CR()
{	

	try {

		$updatepro= $this->zgfcp_cate1bs->updatePro_ZGFCP_Cate1_BS();

		if(isset($updatepro) and $updatepro=='1'){

			return redirect()->route('zgfcp-cate1-list');
		}	

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The category could not be updated.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}	
}

//----------------------------------------------------------
// GET - DELETE PRO CATEGORIES
//----------------------------------------------------------

public function deletePro_ZGFCP_Cate1_CR($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{	

	try {

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

			if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

				$deletepro = $this->zgfcp_cate1bs->deletePro_ZGFCP_Cate1_BS($zgfcp_cate1_id,$zgfcp_cate1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('zgfcp-cate1-list');
				}	
			}			
		}					
			
		throw new Exception();			

	} catch (Exception $e) {

		$flash='The category could not be deleted.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}	
}

//----------------------------------------------------------
// GET - CLONE PRO CATEGORIES
//----------------------------------------------------------

public function clonePro_ZGFCP_Cate1_CR($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{	

	try {

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

			if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

				$zgfcp_cate1_id = $this->zgfcp_cate1bs->clonePro_ZGFCP_Cate1_BS($zgfcp_cate1_id,$zgfcp_cate1_token);	

				if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

					return redirect()->route('zgfcp-cate1-list');
				}	
			}			
		}

		throw new Exception();			

	} catch (Exception $e) {
					
		$flash='The category could not be cloned.';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}
}

//----------------------------------------------------------
// GET - UPDATE IMAGES FORM CATEGORIES
//----------------------------------------------------------

public function updateImages_ZGFCP_Cate1_CR($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{	
	try {

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

			if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

				$categories = $this->zgfcp_cate1bs->update_ZGFCP_Cate1_BS($zgfcp_cate1_id,$zgfcp_cate1_token);

				if($categories->isNotEmpty()){
		
					return view('zgfcp_cate1.zgfcp_cate1_images',compact('categories'));
				} 
			}		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The category does not exist.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}
}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO CATEGORIES
//----------------------------------------------------------

public function updateImagesPro_ZGFCP_Cate1_CR()
{	

	try {

		$backarray= $this->zgfcp_cate1bs->updateImagesPro_ZGFCP_Cate1_BS();

		if(isset($backarray) and $backarray['updateimagespro']=='1'){

			return redirect()->route('zgfcp-cate1-images-update', ['zgfcp_cate1_id' => $backarray['zgfcp_cate1_id'],'zgfcp_cate1_token' => $backarray['zgfcp_cate1_token']]);		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The image could not be updated.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO CATEGORIES
//----------------------------------------------------------

public function deleteImagesPro_ZGFCP_Cate1_CR($zgfcp_cate1_id=null,$zgfcp_cate1_token=null,$image_number=null)
{	

	try {

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

			if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

				if(isset($image_number) and is_numeric($image_number)){

					$deleteimagespro = $this->zgfcp_cate1bs->deleteImagesPro_ZGFCP_Cate1_BS($zgfcp_cate1_id,$zgfcp_cate1_token,$image_number);

					if(isset($deleteimagespro) and $deleteimagespro=='1'){

						return redirect()->route('zgfcp-cate1-images-update', ['zgfcp_cate1_id' => $zgfcp_cate1_id,'zgfcp_cate1_token' => $zgfcp_cate1_token]);		
					}
				}
			}
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The image could not be deleted.';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}
}

//----------------------------------------------------------
// ORDER CATEGORIES
//----------------------------------------------------------

public function order_ZGFCP_Cate1_CR()
{	

	try {

		$categories= $this->zgfcp_cate1bs->getOrder_ZGFCP_Cate1_BS();

		if(isset($categories) and $categories->isNotEmpty()){

			return view('zgfcp_cate1.zgfcp_cate1_order',compact('categories'));
		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The category could not be sorted';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO CATEGORIES
//----------------------------------------------------------

public function orderPro_ZGFCP_Cate1_CR()
{	

	//order pro
	$backarray= $this->zgfcp_cate1bs->orderPro_ZGFCP_Cate1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO CATEGORIES
//----------------------------------------------------------

public function publishPro_ZGFCP_Cate1_CR()
{	

	//publish pro
	$backarray= $this->zgfcp_cate1bs->publishPro_ZGFCP_Cate1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class