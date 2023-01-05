<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\BBP_Prod1BS\BBP_Prod1_Main_BS;


//----------------------------------------------------------
// PRODUCTS CONTROLLER
//----------------------------------------------------------
// Class   : BBP_Prod1Controller
// Used by : BBP_Prod1MainBS
//----------------------------------------------------------
// get_BBP_Prod1_CR
// getSearch_BBP_Prod1_CR
// insert_BBP_Prod1_CR
// insertPro_BBP_Prod1_CR
// update_BBP_Prod1_CR
// updatePro_BBP_Prod1_CR
// deletePro_BBP_Prod1_CR
// clonePro_BBP_Prod1_CR
// updateImages_BBP_Prod1_CR
// updateImagesPro_BBP_Prod1_CR
// deleteImagesPro_BBP_Prod1_CR
// deleteImagesPro_BBP_Prod1_CR
// order_BBP_Prod1_CR
// orderPro_BBP_Prod1_CR
// publishPro_BBP_Prod1_CR
//----------------------------------------------------------

class BBP_Prod1Controller extends Controller
{

//----------------------------------------------------------
// PRODUCTS
//----------------------------------------------------------

public function __construct(BBP_Prod1_Main_BS $bbp_prod1bs)
{
   $this->middleware('auth');
   $this->bbp_prod1bs=$bbp_prod1bs;
} 

//----------------------------------------------------------
// GET PRODUCTS
//----------------------------------------------------------

public function get_BBP_Prod1_CR()
{	

	try {

		$products= $this->bbp_prod1bs->get_BBP_Prod1_BS();

		if($products->isNotEmpty()){
		
			return view('bbp_prod1.bbp_prod1_list',compact('products'));

		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='No hay productos, aqui puedes agregar los que necesitas';			
		return redirect()->route('bbp-prod1-insert')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET SEARCH BANNERA
//----------------------------------------------------------

public function getSearch_BBP_Prod1_CR()
{	

	try {

		$products= $this->bbp_prod1bs->getSearch_BBP_Prod1_BS();

		if($products->isNotEmpty()){
		
			return view('bbp_prod1.bbp_prod1_list',compact('products'));
		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='No hay productos en la búsqueda';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);

	}
}

//----------------------------------------------------------
// GET - INSERT FORM PRODUCTS
//----------------------------------------------------------

public function insert_BBP_Prod1_CR()
{	
		
	return view('bbp_prod1.bbp_prod1_insert');
}

//----------------------------------------------------------
// POST - INSERT PRO PRODUCTS
//----------------------------------------------------------

public function insertPro_BBP_Prod1_CR()
{	

	try {

		//insert pro
		$bbp_prod1_id= $this->bbp_prod1bs->insertPro_BBP_Prod1_BS();	

		if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){
			
			return redirect()->route('bbp-prod1-list');
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		//--------------------------------------------------------------------------
		//error message
		$flash='El producto no se pudo insertar.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);
		//--------------------------------------------------------------------------
	}

}

//----------------------------------------------------------
// GET - UPDATE DATA FORM PRODUCTS
//----------------------------------------------------------

public function update_BBP_Prod1_CR($bbp_prod1_id=null,$bbp_prod1_token=null)
{	

	try {

		if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

			if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

				//update form
				$products = $this->bbp_prod1bs->update_BBP_Prod1_BS($bbp_prod1_id,$bbp_prod1_token);

				if($products->isNotEmpty()){
		
					return view('bbp_prod1.bbp_prod1_update',compact('products'));
				} 
			}		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='El producto que buscas, no existe.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO PRODUCTS
//----------------------------------------------------------

public function updatePro_BBP_Prod1_CR()
{	

	try {

		$updatepro= $this->bbp_prod1bs->updatePro_BBP_Prod1_BS();

		if(isset($updatepro) and $updatepro=='1'){

			return redirect()->route('bbp-prod1-list');
		}	

		throw new Exception();			

	} catch (Exception $e) {

		$flash='El producto no se actualizo.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);
	}		

}

//----------------------------------------------------------
// GET - DELETE PRO PRODUCTS
//----------------------------------------------------------

public function deletePro_BBP_Prod1_CR($bbp_prod1_id=null,$bbp_prod1_token=null)
{	

	try {

		if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

			if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

				$deletepro = $this->bbp_prod1bs->deletePro_BBP_Prod1_BS($bbp_prod1_id,$bbp_prod1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('bbp-prod1-list');

				}	
			}
			
		}

		throw new Exception();			

	} catch (Exception $e) {
				
		$flash='El producto no se pudo eliminar.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);
	}	

}

//----------------------------------------------------------
// GET - CLONE PRO PRODUCTS
//----------------------------------------------------------

public function clonePro_BBP_Prod1_CR($bbp_prod1_id=null,$bbp_prod1_token=null)
{	

	try {

		if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

			if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

				$bbp_prod1_id = $this->bbp_prod1bs->clonePro_BBP_Prod1_BS($bbp_prod1_id,$bbp_prod1_token);	

				if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

					return redirect()->route('bbp-prod1-list');

				}	

			}
			
		}

		throw new Exception();			

	} catch (Exception $e) {
					
		$flash='El producto no se pudo clonar.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);

	}


}

//----------------------------------------------------------
// GET - UPDATE IMAGES FORM PRODUCTS
//----------------------------------------------------------

public function updateImages_BBP_Prod1_CR($bbp_prod1_id=null,$bbp_prod1_token=null)
{	

	try {
	
		if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

			if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

				$products = $this->bbp_prod1bs->update_BBP_Prod1_BS($bbp_prod1_id,$bbp_prod1_token);

				if($products->isNotEmpty()){
		
					return view('bbp_prod1.bbp_prod1_images',compact('products'));

				} 

			}
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='El producto no existe.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);
	}	

}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO PRODUCTS
//----------------------------------------------------------

public function updateImagesPro_BBP_Prod1_CR()
{	
	try {

		$backarray= $this->bbp_prod1bs->updateImagesPro_BBP_Prod1_BS();

		if(isset($backarray) and $backarray['updateimagespro']=='1'){

			return redirect()->route('bbp-prod1-images-update', ['bbp_prod1_id' => $backarray['bbp_prod1_id'],'bbp_prod1_token' => $backarray['bbp_prod1_token']]);
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='la imagen no se pudo actualizar.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);
	}
			
}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO PRODUCTS
//----------------------------------------------------------

public function deleteImagesPro_BBP_Prod1_CR($bbp_prod1_id=null,$bbp_prod1_token=null,$image_number=null)
{	

	try {

		if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

			if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

				if(isset($image_number) and is_numeric($image_number)){

					$deleteimagespro = $this->bbp_prod1bs->deleteImagesPro_BBP_Prod1_BS($bbp_prod1_id,$bbp_prod1_token,$image_number);

					if(isset($deleteimagespro) and $deleteimagespro=='1'){

						return redirect()->route('bbp-prod1-images-update', ['bbp_prod1_id' => $bbp_prod1_id,'bbp_prod1_token' => $bbp_prod1_token]);			

					}
				}
			}			
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La imagen no se pudo eliminar.';			
		return redirect()->route('bbp-prod1-list')->with('mal', $flash);

	}
}

//----------------------------------------------------------
// ORDER PRODUCTS
//----------------------------------------------------------

public function order_BBP_Prod1_CR()
{	
	try {

		$products= $this->bbp_prod1bs->getOrder_BBP_Prod1_BS();

		if(isset($products) and $products->isNotEmpty()){

			return view('bbp_prod1.bbp_prod1_order',compact('products'));
		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='No hay productos, aqui puedes agregar los que necesitas';			
		return redirect()->route('bbp-prod1-insert')->with('mal', $flash);

	}

}

//----------------------------------------------------------
//----------------------- ANGULAR ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO PRODUCTS
//----------------------------------------------------------

public function orderPro_BBP_Prod1_CR()
{	

	$backarray= $this->bbp_prod1bs->orderPro_BBP_Prod1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO PRODUCTS
//----------------------------------------------------------

public function publishPro_BBP_Prod1_CR()
{	

	$backarray= $this->bbp_prod1bs->publishPro_BBP_Prod1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class