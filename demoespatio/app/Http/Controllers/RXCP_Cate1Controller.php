<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;

use App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Cate1BS\RXCP_Cate1_Main_BS;


//----------------------------------------------------------
// RXCP_Cate1 CONTROLLER
//----------------------------------------------------------
// Class   : RXCP_Cate1Controller
// Used by : RXCP_Cate1_Main_BS
//----------------------------------------------------------
// get_RXCP_Cate1_CR
// insert_RXCP_Cate1_CR
// insertPro_RXCP_Cate1_CR
// update_RXCP_Cate1_CR
// updatePro_RXCP_Cate1_CR
// deletePro_RXCP_Cate1_CR
// clonePro_RXCP_Cate1_CR
// updateImages_RXCP_Cate1_CR
// updateImagesPro_RXCP_Cate1_CR
// deleteImagesPro_RXCP_Cate1_CR
// order_RXCP_Cate1_CR
// orderPro_RXCP_Cate1_CR
// publishPro_RXCP_Cate1_CR
//----------------------------------------------------------

class RXCP_Cate1Controller extends Controller
{

//----------------------------------------------------------
// CATEGORIES
//----------------------------------------------------------

public function __construct(RXCP_Cate1_Main_BS $rxcp_cate1bs)
{
   $this->middleware('auth');
   $this->rxcp_cate1bs=$rxcp_cate1bs;
} 

//----------------------------------------------------------
// GET CATEGORIES
//----------------------------------------------------------

public function get_RXCP_Cate1_CR()
{	
	try {

		$backarray= $this->rxcp_cate1bs->get_RXCP_Cate1_BS();

		$categories=$backarray['categories'];

		$countprod1xcate1=$backarray['countprod1xcate1'];

		if($categories->isNotEmpty()){
		
			return view('rxcp_cate1.rxcp_cate1_list',compact('categories','countprod1xcate1'));

		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='No hay categorias, aqui puedes agregar las que necesitas';			
		return redirect()->route('rxcp-cate1-insert')->with('mal', $flash);
	}

}

//----------------------------------------------------------
// GET - INSERT FORM CATEGORIES
//----------------------------------------------------------

public function insert_RXCP_Cate1_CR()
{	
		
	return view('rxcp_cate1.rxcp_cate1_insert');
}

//----------------------------------------------------------
// POST - INSERT PRO CATEGORIES
//----------------------------------------------------------

public function insertPro_RXCP_Cate1_CR()
{	

	try {

		$rxcp_cate1_id= $this->rxcp_cate1bs->insertPro_RXCP_Cate1_BS();	

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){
			
			return redirect()->route('rxcp-cate1-list');
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La categoria no se pudo insertar.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// GET - UPDATE DATA FORM CATEGORIES
//----------------------------------------------------------

public function update_RXCP_Cate1_CR($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{	
	try {

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

			if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

				$categories = $this->rxcp_cate1bs->update_RXCP_Cate1_BS($rxcp_cate1_id,$rxcp_cate1_token);

				if($categories->isNotEmpty()){
		
					return view('rxcp_cate1.rxcp_cate1_update',compact('categories'));
				} 
			}		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La categoria no se pudo mostrar.';	
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);

	}	

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO CATEGORIES
//----------------------------------------------------------

public function updatePro_RXCP_Cate1_CR()
{	

	try {

		$updatepro= $this->rxcp_cate1bs->updatePro_RXCP_Cate1_BS();

		if(isset($updatepro) and $updatepro=='1'){

			return redirect()->route('rxcp-cate1-list');
		}	

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La categoria no se actualizo.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);

	}		

}

//----------------------------------------------------------
// GET - DELETE PRO CATEGORIES
//----------------------------------------------------------

public function deletePro_RXCP_Cate1_CR($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{	

	try {

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

			if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

				//delete pro
				$deletepro = $this->rxcp_cate1bs->deletePro_RXCP_Cate1_BS($rxcp_cate1_id,$rxcp_cate1_token);

				if(isset($deletepro) and $deletepro=='1'){

					return redirect()->route('rxcp-cate1-list');
				}	
			}			
		}

		throw new Exception();			

	} catch (Exception $e) {
					
		$flash='La categoria no se pudo eliminar.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// GET - CLONE PRO CATEGORIES
//----------------------------------------------------------

public function clonePro_RXCP_Cate1_CR($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{	
	try {

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

			if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

				$rxcp_cate1_id = $this->rxcp_cate1bs->clonePro_RXCP_Cate1_BS($rxcp_cate1_id,$rxcp_cate1_token);	

				if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

					return redirect()->route('rxcp-cate1-list');
				}
			}			
		}

		throw new Exception();			

	} catch (Exception $e) {
					
		$flash='La categoria no se pudo clonar.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);
	}	


}

//----------------------------------------------------------
//----------------------- IMAGES ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// GET - UPDATE IMAGES FORM CATEGORIES
//----------------------------------------------------------

public function updateImages_RXCP_Cate1_CR($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{	
	try {

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

			if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

				$categories = $this->rxcp_cate1bs->update_RXCP_Cate1_BS($rxcp_cate1_id,$rxcp_cate1_token);

				if($categories->isNotEmpty()){
		
					return view('rxcp_cate1.rxcp_cate1_images',compact('categories'));

				} 

			}
		
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La categoria que buscas, no existe.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);

	}

}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO CATEGORIES
//----------------------------------------------------------

public function updateImagesPro_RXCP_Cate1_CR()
{	
	try {

		$backarray= $this->rxcp_cate1bs->updateImagesPro_RXCP_Cate1_BS();

		if(isset($backarray) and $backarray['updateimagespro']=='1'){

			return redirect()->route('rxcp-cate1-images-update', ['rxcp_cate1_id' => $backarray['rxcp_cate1_id'],'rxcp_cate1_token' => $backarray['rxcp_cate1_token']]);
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La imagen no se pudo actualizar.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);
	}
}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO CATEGORIES
//----------------------------------------------------------

public function deleteImagesPro_RXCP_Cate1_CR($rxcp_cate1_id=null,$rxcp_cate1_token=null,$image_number=null)
{	
	try {

		if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

			if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

				if(isset($image_number) and is_numeric($image_number)){

					$deleteimagespro = $this->rxcp_cate1bs->deleteImagesPro_RXCP_Cate1_BS($rxcp_cate1_id,$rxcp_cate1_token,$image_number);

					if(isset($deleteimagespro) and $deleteimagespro=='1'){

						return redirect()->route('rxcp-cate1-images-update', ['rxcp_cate1_id' => $rxcp_cate1_id,'rxcp_cate1_token' => $rxcp_cate1_token]);		

					}
				}
			}
		}

		throw new Exception();			

	} catch (Exception $e) {

		$flash='La imagen no se pudo eliminar.';			
		return redirect()->route('rxcp-cate1-list')->with('mal', $flash);
	}
}

//----------------------------------------------------------
// ORDER CATEGORIES
//----------------------------------------------------------

public function order_RXCP_Cate1_CR()
{	
	try {

		$categories= $this->rxcp_cate1bs->getOrder_RXCP_Cate1_BS();

		if(isset($categories) and $categories->isNotEmpty()){

			return view('rxcp_cate1.rxcp_cate1_order',compact('categories'));
		} 

		throw new Exception();			

	} catch (Exception $e) {

		$flash='No hay categorias, aqui puedes agregar las que necesitas';			
		return redirect()->route('rxcp-cate1-insert')->with('mal', $flash);
	}

}

//----------------------------------------------------------
//----------------------- ANGULAR ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO CATEGORIES
//----------------------------------------------------------

public function orderPro_RXCP_Cate1_CR()
{	

	//order pro
	$backarray= $this->rxcp_cate1bs->orderPro_RXCP_Cate1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO CATEGORIES
//----------------------------------------------------------

public function publishPro_RXCP_Cate1_CR()
{	

	//publish pro
	$backarray= $this->rxcp_cate1bs->publishPro_RXCP_Cate1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class