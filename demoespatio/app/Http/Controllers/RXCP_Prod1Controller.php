<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Prod1BS\RXCP_Prod1_Main_BS;

//----------------------------------------------------------
// PRODUCTS CONTROLLER
//----------------------------------------------------------
// Class   : RXCP_Prod1Controller
// Used by : RXCP_Prod1_Main_BS
//----------------------------------------------------------
// get_RXCP_Prod1_CR
// getSearch_RXCP_Prod1_CR
// getSearchLink_RXCP_Prod1_CR
// insert_RXCP_Prod1_CR
// insertPro_RXCP_Prod1_CR
// update_RXCP_Prod1_CR
// updatePro_RXCP_Prod1_CR
// deletePro_RXCP_Prod1_CR
// clonePro_RXCP_Prod1_CR
// updateImages_RXCP_Prod1_CR
// updateImagesPro_RXCP_Prod1_CR
// deleteImagesPro_RXCP_Prod1_CR
// order_RXCP_Prod1_CR
// orderPro_RXCP_Prod1_CR
// publishPro_RXCP_Prod1_CR
//----------------------------------------------------------

class RXCP_Prod1Controller extends Controller
{

//----------------------------------------------------------
// PRODUCTS
//----------------------------------------------------------

public function __construct(RXCP_Prod1_Main_BS $rxcp_prod1bs)
{
   $this->middleware('auth');
   $this->rxcp_prod1bs=$rxcp_prod1bs;
} 

//----------------------------------------------------------
// GET - LIST PRODUCTS
//----------------------------------------------------------

public function get_RXCP_Prod1_CR()
{	

	try {

		$backarray= $this->rxcp_prod1bs->get_RXCP_Prod1_BS();

		if($backarray['products']->isNotEmpty()){

			$bgcolor='';

			$categories=$backarray['categories'];
			
			$products=$backarray['products'];
		
			return view('rxcp_prod1.rxcp_prod1_list',compact('categories','products','bgcolor'));

		} 

	throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no products';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - SEARCH LIST PRODUCT
//----------------------------------------------------------
public function getSearch_RXCP_Prod1_CR()
{	
	try {		

		$backarray= $this->rxcp_prod1bs->getSearch_RXCP_Prod1_BS();

		if($backarray['products']->isNotEmpty()){

			$bgcolor='';

			$categories=$backarray['categories'];
			
			$products=$backarray['products'];
		
			return view('rxcp_prod1.rxcp_prod1_list',compact('categories','products','bgcolor'));

		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no products';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// POST - SEARCH LINK PRODUCT
//----------------------------------------------------------
public function getSearchLink_RXCP_Prod1_CR($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{	
	try {

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

			if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

				$backarray= $this->rxcp_prod1bs->getSearchLink_RXCP_Prod1_BS($rxcp_cate1_id,$rxcp_cate1_token);

				if($backarray['products']->isNotEmpty()){

					$bgcolor='';

					$categories=$backarray['categories'];
						
					$products=$backarray['products'];
					
					return view('rxcp_prod1.rxcp_prod1_list',compact('categories','products','bgcolor'));
				} 
			} 
		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no products';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// GET - INSERT FORM PRODUCTS
//----------------------------------------------------------

public function insert_RXCP_Prod1_CR()
{	

	$categories= $this->rxcp_prod1bs->insert_RXCP_Prod1_BS();
	
	return view('rxcp_prod1.rxcp_prod1_insert',compact('categories'));
}

//----------------------------------------------------------
// POST - INSERT PRO PRODUCTS
//----------------------------------------------------------

public function insertPro_RXCP_Prod1_CR()
{	

	try {

		$rxcp_prod1_id= $this->rxcp_prod1bs->insertPro_RXCP_Prod1_BS();	

		if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){
			
			return redirect()->route('rxcp-prod1-list');
		
		}

		throw new Exception();			

	} catch (Exception $e) {

	$flash='The product could not be created.';			
	return redirect()->route('show-error-message')->with('mal', $flash);	

	}

}

//----------------------------------------------------------
// GET - UPDATE DATA FORM CATE1-PROD1
//----------------------------------------------------------

public function update_RXCP_Prod1_CR($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{	
	try {

		if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

			if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

				$backarray = $this->rxcp_prod1bs->update_RXCP_Prod1_BS($rxcp_prod1_id,$rxcp_prod1_token);

				if($backarray['products']->isNotEmpty()){

					$categories = $backarray['categories'];
					$products	= $backarray['products'];
		
					return view('rxcp_prod1.rxcp_prod1_update',compact('categories','products'));
				} 
			}		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no products';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO PRODUCTS
//----------------------------------------------------------

public function updatePro_RXCP_Prod1_CR()
{	

	try {

		$updatepro= $this->rxcp_prod1bs->updatePro_RXCP_Prod1_BS();

		if(isset($updatepro) and $updatepro=='1'){

			return redirect()->route('rxcp-prod1-list');
		}
		
		throw new Exception();			

	} catch (Exception $e) {

		$flash='The product could not be modified.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}		

}

//----------------------------------------------------------
// GET - DELETE PRO PRODUCTS
//----------------------------------------------------------

public function deletePro_RXCP_Prod1_CR($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{	
	try {

		if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

			if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){
				
				$deletepro = $this->rxcp_prod1bs->deletePro_RXCP_Prod1_BS($rxcp_prod1_id,$rxcp_prod1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('rxcp-prod1-list');

				}	
			}
			
		}

		throw new Exception();			

	} catch (Exception $e) {
				
		$flash='The product could not be removed.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - CLONE PRO PRODUCTS
//----------------------------------------------------------

public function clonePro_RXCP_Prod1_CR($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{	

	try {

		if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

			if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

				$rxcp_prod1_id = $this->rxcp_prod1bs->clonePro_RXCP_Prod1_BS($rxcp_prod1_id,$rxcp_prod1_token);	

				if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

					return redirect()->route('rxcp-prod1-list');
				}
			}			
		}

		throw new Exception();			

	} catch (Exception $e) {
					
		$flash='The product could not be cloned.';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - UPDATE IMAGES FORM PRODUCTS
//----------------------------------------------------------

public function updateImages_RXCP_Prod1_CR($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{	
	try {

		if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

			if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

				//update form
				$backarray = $this->rxcp_prod1bs->update_RXCP_Prod1_BS($rxcp_prod1_id,$rxcp_prod1_token);

				if($backarray['products']->isNotEmpty()){

					$categories = $backarray['categories'];
					$products	= $backarray['products'];

					return view('rxcp_prod1.rxcp_prod1_images',compact('categories','products'));

				} 
			}		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no products.';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO PRODUCTS
//----------------------------------------------------------

public function updateImagesPro_RXCP_Prod1_CR()
{	

	try {

		$backarray= $this->rxcp_prod1bs->updateImagesPro_RXCP_Prod1_BS();

		if(isset($backarray) and $backarray['updateimagespro']=='1'){

			return redirect()->route('rxcp-prod1-images-update', ['rxcp_prod1_id' => $backarray['rxcp_prod1_id'],'rxcp_prod1_token' => $backarray['rxcp_prod1_token']]);
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='The image could not be updated.';			
		return redirect()->route('show-error-message')->with('mal', $flash);

	}
			
}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO PRODUCTS
//----------------------------------------------------------

public function deleteImagesPro_RXCP_Prod1_CR($rxcp_prod1_id=null,$rxcp_prod1_token=null,$image_number=null)
{	

	try {

		if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

			if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

				if(isset($image_number) and is_numeric($image_number)){

					$deleteimagespro = $this->rxcp_prod1bs->deleteImagesPro_RXCP_Prod1_BS($rxcp_prod1_id,$rxcp_prod1_token,$image_number);

					if(isset($deleteimagespro) and $deleteimagespro=='1'){

						return redirect()->route('rxcp-prod1-images-update', ['rxcp_prod1_id' => $rxcp_prod1_id,'rxcp_prod1_token' => $rxcp_prod1_token]);

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
// ORDER PRODUCTS
//----------------------------------------------------------

public function order_RXCP_Prod1_CR()
{	

	try {

		$products= $this->rxcp_prod1bs->getOrder_RXCP_Prod1_BS();

		if(isset($products) and $products->isNotEmpty()){

			return view('rxcp_prod1.rxcp_prod1_order',compact('products'));
		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='There are no products to order';			
		return redirect()->route('show-error-message')->with('mal', $flash);
	}

}

//----------------------------------------------------------
//----------------------- ANGULAR ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO PRODUCTS
//----------------------------------------------------------

public function orderPro_RXCP_Prod1_CR()
{	

	//order pro
	$backarray= $this->rxcp_prod1bs->orderPro_RXCP_Prod1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO PRODUCTS
//----------------------------------------------------------

public function publishPro_RXCP_Prod1_CR()
{	

	//publish pro
	$backarray= $this->rxcp_prod1bs->publishPro_RXCP_Prod1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class