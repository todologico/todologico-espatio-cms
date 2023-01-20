<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Prod1BS\ZGFCP_Prod1_Main_BS;

//----------------------------------------------------------
// PRODUCTS CONTROLLER
//----------------------------------------------------------
// Class   : ZGFCP_Prod1Controller
// Used by : ZGFCP_Prod1_Main_BS
//----------------------------------------------------------
// get_ZGFCP_Prod1_CR
// getSearch_ZGFCP_Prod1_CR
// getSearchLink_ZGFCP_Prod1_CR
// insert_ZGFCP_Prod1_CR
// insertPro_ZGFCP_Prod1_CR
// update_ZGFCP_Prod1_CR
// updatePro_ZGFCP_Prod1_CR
// deletePro_ZGFCP_Prod1_CR
// clonePro_ZGFCP_Prod1_CR
// updateImages_ZGFCP_Prod1_CR
// updateImagesPro_ZGFCP_Prod1_CR
// deleteImagesPro_ZGFCP_Prod1_CR
// order_ZGFCP_Prod1_CR
// orderPro_ZGFCP_Prod1_CR
// publishPro_ZGFCP_Prod1_CR
//----------------------------------------------------------

class ZGFCP_Prod1Controller extends Controller
{

//----------------------------------------------------------
// PRODUCTS
//----------------------------------------------------------

public function __construct(ZGFCP_Prod1_Main_BS $zgfcp_prod1bs)
{
   $this->middleware('auth');
   $this->zgfcp_prod1bs=$zgfcp_prod1bs;
} 

//----------------------------------------------------------
// GET - LIST PRODUCTS
//----------------------------------------------------------

public function get_ZGFCP_Prod1_CR()
{	

	try {

		$backarray= $this->zgfcp_prod1bs->get_ZGFCP_Prod1_BS();

		if($backarray['products']->isNotEmpty()){

			$families=$backarray['families'];
			
			$categories=$backarray['categories'];
			
			$products=$backarray['products'];
		
			return view('zgfcp_prod1.zgfcp_prod1_list',compact('families','categories','products'));
		} 

		throw new Exception();

	} catch(Exception $e) {

		$flash='There are no products.';			
		return redirect()->route('zgfcp-prod1-insert')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - SEARCH FORM TEXT LIST PRODUCT
//----------------------------------------------------------
public function getSearch_ZGFCP_Prod1_CR()
{	

	try {

		$backarray= $this->zgfcp_prod1bs->getSearch_ZGFCP_Prod1_BS();

		if($backarray['products']->isNotEmpty()){

			$families=$backarray['families'];

			$categories=$backarray['categories'];
			
			$products=$backarray['products'];
		
			return view('zgfcp_prod1.zgfcp_prod1_list',compact('families','categories','products'));

		} 

		throw new Exception();


	} catch (Exception $e) {

		$flash='There are no products.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - SEARCH LINK PRODUCT BY FAMI1
//----------------------------------------------------------
public function getSearchLinkxFami1_ZGFCP_Prod1_CR($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{	

	try {

		if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

			if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

				$backarray= $this->zgfcp_prod1bs->getSearchLinkxFami1_ZGFCP_Prod1_BS($zgfcp_fami1_id,$zgfcp_fami1_token);

				if($backarray['products']->isNotEmpty()){

					$families=$backarray['families'];

					$categories=$backarray['categories'];
						
					$products=$backarray['products'];
					
					return view('zgfcp_prod1.zgfcp_prod1_list',compact('families','categories','products'));
				} 
			} 
		} 

		throw new Exception();

	} catch (Exception $e) {

		$flash='There are no products.';			
	return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// POST - SEARCH LINK PRODUCT BY CATE1
//----------------------------------------------------------
public function getSearchLinkxCate1_ZGFCP_Prod1_CR($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{	

	try {

		if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

			if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

				$backarray= $this->zgfcp_prod1bs->getSearchLinkxCate1_ZGFCP_Prod1_BS($zgfcp_cate1_id,$zgfcp_cate1_token);

				if($backarray['products']->isNotEmpty()){

					$families=$backarray['families'];

					$categories=$backarray['categories'];
						
					$products=$backarray['products'];
					
					return view('zgfcp_prod1.zgfcp_prod1_list',compact('families','categories','products'));
				} 
			} 
		} 

		throw new Exception();

	} catch(Exception $e) {

		$flash='There are no products.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - INSERT FORM PRODUCTS
//----------------------------------------------------------

public function insert_ZGFCP_Prod1_CR()
{	

	$categories= $this->zgfcp_prod1bs->insert_ZGFCP_Prod1_BS();
	
	return view('zgfcp_prod1.zgfcp_prod1_insert',compact('categories'));
}

//----------------------------------------------------------
// POST - INSERT PRO PRODUCTS
//----------------------------------------------------------

public function insertPro_ZGFCP_Prod1_CR()
{	
	try {

		$zgfcp_prod1_id= $this->zgfcp_prod1bs->insertPro_ZGFCP_Prod1_BS();	

		if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){
			
			return redirect()->route('zgfcp-prod1-list');
	
		}

		throw new Exception();

	} catch(Exception $e) {

		$flash='The product could not be created.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);

	}
}

//----------------------------------------------------------
// GET - UPDATE DATA FORM CATE1-PROD1
//----------------------------------------------------------

public function update_ZGFCP_Prod1_CR($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{	
	try {

		if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

			if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

				$backarray = $this->zgfcp_prod1bs->update_ZGFCP_Prod1_BS($zgfcp_prod1_id,$zgfcp_prod1_token);

				if($backarray['products']->isNotEmpty()){

					$categories = $backarray['categories'];
					$products	= $backarray['products'];
		
					return view('zgfcp_prod1.zgfcp_prod1_update',compact('categories','products'));
				} 
			}		
		}

		throw new Exception();

	} catch (Exception $e) {

		$flash='There are no products.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO PRODUCTS
//----------------------------------------------------------

public function updatePro_ZGFCP_Prod1_CR()
{	

	try {

		$updatepro= $this->zgfcp_prod1bs->updatePro_ZGFCP_Prod1_BS();

		if(isset($updatepro) and $updatepro=='1'){

			return redirect()->route('zgfcp-prod1-list');
		}	

		throw new Exception();

	} catch (Exception $e) {

		$flash='The product could not be modified.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - DELETE PRO PRODUCTS
//----------------------------------------------------------

public function deletePro_ZGFCP_Prod1_CR($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{	

	try {

		if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

			if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){
				
				$deletepro = $this->zgfcp_prod1bs->deletePro_ZGFCP_Prod1_BS($zgfcp_prod1_id,$zgfcp_prod1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('zgfcp-prod1-list');

				}	
			}			
		}

		throw new Exception();

	} catch (Exception $e) {
					
		$flash='Product could not be removed.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - CLONE PRO PRODUCTS
//----------------------------------------------------------

public function clonePro_ZGFCP_Prod1_CR($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{	
	try {

		if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

			if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

				$zgfcp_prod1_id = $this->zgfcp_prod1bs->clonePro_ZGFCP_Prod1_BS($zgfcp_prod1_id,$zgfcp_prod1_token);	

				if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

					return redirect()->route('zgfcp-prod1-list');
				}
			}			
		}

		throw new Exception();

	} catch (Exception $e) {
					
		$flash='The product could not be cloned.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);

	}
}


//----------------------------------------------------------
// GET - UPDATE IMAGES FORM PRODUCTS
//----------------------------------------------------------

public function updateImages_ZGFCP_Prod1_CR($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{	
	try {

		if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

			if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

				$backarray = $this->zgfcp_prod1bs->update_ZGFCP_Prod1_BS($zgfcp_prod1_id,$zgfcp_prod1_token);

				if($backarray['products']->isNotEmpty()){

					$categories = $backarray['categories'];
					$products	= $backarray['products'];
		
					return view('zgfcp_prod1.zgfcp_prod1_images',compact('categories','products'));
				} 
			}		
		}

		throw new Exception();

	} catch (Exception $e) {

		$flash='There are no products.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);
		
	}
}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO PRODUCTS
//----------------------------------------------------------

public function updateImagesPro_ZGFCP_Prod1_CR()
{	
	try {

		$backarray= $this->zgfcp_prod1bs->updateImagesPro_ZGFCP_Prod1_BS();

		if(isset($backarray) and $backarray['updateimagespro']=='1'){

			return redirect()->route('zgfcp-prod1-images-update', ['zgfcp_prod1_id' => $backarray['zgfcp_prod1_id'],'zgfcp_prod1_token' => $backarray['zgfcp_prod1_token']]);
		}

		throw new Exception();

	} catch (Exception $e) {

		$flash='The image could not be updated.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);

	}				
}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO PRODUCTS
//----------------------------------------------------------

public function deleteImagesPro_ZGFCP_Prod1_CR($zgfcp_prod1_id=null,$zgfcp_prod1_token=null,$image_number=null)
{	

	try {

		if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

			if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

				if(isset($image_number) and is_numeric($image_number)){

					$deleteimagespro = $this->zgfcp_prod1bs->deleteImagesPro_ZGFCP_Prod1_BS($zgfcp_prod1_id,$zgfcp_prod1_token,$image_number);

					if(isset($deleteimagespro) and $deleteimagespro=='1'){

						return redirect()->route('zgfcp-prod1-images-update', ['zgfcp_prod1_id' => $zgfcp_prod1_id,'zgfcp_prod1_token' => $zgfcp_prod1_token]);			

					}
				}
			}			
		}

		throw new Exception();

	} catch (Exception $e) {

		$flash='The image could not be deleted.';			
		return redirect()->route('zgfcp-prod1-list')->with('mal', $flash);

	}
}

//----------------------------------------------------------
// ORDER PRODUCTS
//----------------------------------------------------------

public function order_ZGFCP_Prod1_CR()
{	

	try {

		$products= $this->zgfcp_prod1bs->getOrder_ZGFCP_Prod1_BS();

		if(isset($products) and $products->isNotEmpty()){

			return view('zgfcp_prod1.zgfcp_prod1_order',compact('products'));
		} 

		throw new Exception();

	} catch (Exception $e) {

		$flash='There are no products to order';			
		return redirect()->route('zgfcp-prod1-insert')->with('mal', $flash);
		
	}

}

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO PRODUCTS
//----------------------------------------------------------

public function orderPro_ZGFCP_Prod1_CR()
{	

	//order pro
	$backarray= $this->zgfcp_prod1bs->orderPro_ZGFCP_Prod1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO PRODUCTS
//----------------------------------------------------------

public function publishPro_ZGFCP_Prod1_CR()
{	

	//publish pro
	$backarray= $this->zgfcp_prod1bs->publishPro_ZGFCP_Prod1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class