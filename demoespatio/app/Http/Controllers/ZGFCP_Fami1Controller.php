<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Fami1BS\ZGFCP_Fami1_Main_BS;

//----------------------------------------------------------
// ZGFCP_Fami1 CONTROLLER
//----------------------------------------------------------
// Class   : ZGFCP_Fami1Controller
// Used by : ZGFCP_Fami1_Main_BS
//----------------------------------------------------------
// get_ZGFCP_Fami1_CR
// insert_ZGFCP_Fami1_CR
// insertPro_ZGFCP_Fami1_CR
// update_ZGFCP_Fami1_CR
// updatePro_ZGFCP_Fami1_CR
// deletePro_ZGFCP_Fami1_CR
// clonePro_ZGFCP_Fami1_CR
// updateImages_ZGFCP_Fami1_CR
// updateImagesPro_ZGFCP_Fami1_CR
// deleteImagesPro_ZGFCP_Fami1_CR
// order_ZGFCP_Fami1_CR
// orderPro_ZGFCP_Fami1_CR
// publishPro_ZGFCP_Fami1_CR
//----------------------------------------------------------

class ZGFCP_Fami1Controller extends Controller
{

//----------------------------------------------------------
// CATEGORIES
//----------------------------------------------------------

public function __construct(ZGFCP_Fami1_Main_BS $zgfcp_fami1bs)
{
   $this->middleware('auth');
   $this->zgfcp_fami1bs=$zgfcp_fami1bs;
} 

//----------------------------------------------------------
// GET CATEGORIES
//----------------------------------------------------------

public function get_ZGFCP_Fami1_CR()
{	

	$backarray= $this->zgfcp_fami1bs->get_ZGFCP_Fami1_BS();

	$families=$backarray['families'];

    //counting the categories of each family
	$countcate1xfami1=$backarray['countcate1xfami1'];

    //counting the products of each family
	$countprod1xfami1=$backarray['countprod1xfami1'];

	if($families->isNotEmpty()){
	
		return view('zgfcp_fami1.zgfcp_fami1_list',compact('families','countcate1xfami1','countprod1xfami1'));

	} 

	//--------------------------------------------------------------------------
	//error message
	$flash='No hay categorias, aqui puedes agregar las que necesitas';			
	return redirect()->route('zgfcp-fami1-insert')->with('mal', $flash);
	//--------------------------------------------------------------------------

}

//----------------------------------------------------------
// GET - INSERT FORM CATEGORIES
//----------------------------------------------------------

public function insert_ZGFCP_Fami1_CR()
{	
		
	return view('zgfcp_fami1.zgfcp_fami1_insert');
}

//----------------------------------------------------------
// POST - INSERT PRO CATEGORIES
//----------------------------------------------------------

public function insertPro_ZGFCP_Fami1_CR()
{	

	//insert pro
	$zgfcp_fami1_id= $this->zgfcp_fami1bs->insertPro_ZGFCP_Fami1_BS();	

	if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){
		
   	return redirect()->route('zgfcp-fami1-list');
	
	}

	//--------------------------------------------------------------------------
	//error message
	$flash='La categoria no se pudo insertar.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------

}

//----------------------------------------------------------
// GET - UPDATE DATA FORM CATEGORIES
//----------------------------------------------------------

public function update_ZGFCP_Fami1_CR($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{	
	$families=null;

	if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

      if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

			//update form
			$families = $this->zgfcp_fami1bs->update_ZGFCP_Fami1_BS($zgfcp_fami1_id,$zgfcp_fami1_token);

			if($families->isNotEmpty()){
	
				return view('zgfcp_fami1.zgfcp_fami1_update',compact('families'));

	 		} 

		}
	
	}

	//--------------------------------------------------------------------------
	//error message
	$flash='La categoria que buscas, no existe.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------	

}

//----------------------------------------------------------
// POST - UPDATE DATA PRO CATEGORIES
//----------------------------------------------------------

public function updatePro_ZGFCP_Fami1_CR()
{	

	//update pro
	$updatepro= $this->zgfcp_fami1bs->updatePro_ZGFCP_Fami1_BS();

	if(isset($updatepro) and $updatepro=='1'){

		return redirect()->route('zgfcp-fami1-list');

	}	

	//--------------------------------------------------------------------------
	//error message
	$flash='La categoria no se actualizo.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------			

}

//----------------------------------------------------------
// GET - DELETE PRO CATEGORIES
//----------------------------------------------------------

public function deletePro_ZGFCP_Fami1_CR($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{	

   if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

      if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

			//delete pro
			$deletepro = $this->zgfcp_fami1bs->deletePro_ZGFCP_Fami1_BS($zgfcp_fami1_id,$zgfcp_fami1_token);

			if(isset($deletepro) and $deletepro=='1'){

	   		return redirect()->route('zgfcp-fami1-list');

			}	
		}
	
	}
				
  	//--------------------------------------------------------------------------
	//error message
	$flash='La categoria no se pudo eliminar.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------	

}

//----------------------------------------------------------
// GET - CLONE PRO CATEGORIES
//----------------------------------------------------------

public function clonePro_ZGFCP_Fami1_CR($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{	

   if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

      if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

			//$zgfcp_fami1_id was inserted
			$zgfcp_fami1_id = $this->zgfcp_fami1bs->clonePro_ZGFCP_Fami1_BS($zgfcp_fami1_id,$zgfcp_fami1_token);	

			if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

	   		return redirect()->route('zgfcp-fami1-list');

			}	

		}
	
	}
				
   //--------------------------------------------------------------------------
	//error message
	$flash='La categoria no se pudo clonar.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------	


}

//----------------------------------------------------------
//----------------------- IMAGES ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// GET - UPDATE IMAGES FORM CATEGORIES
//----------------------------------------------------------

public function updateImages_ZGFCP_Fami1_CR($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{	
	$families=null;

	if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

      if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

			//update form
			$families = $this->zgfcp_fami1bs->update_ZGFCP_Fami1_BS($zgfcp_fami1_id,$zgfcp_fami1_token);

			if($families->isNotEmpty()){
	
				return view('zgfcp_fami1.zgfcp_fami1_images',compact('families'));

	 		} 

		}
	
	}

	//--------------------------------------------------------------------------
	//error message
	$flash='La categoria que buscas, no existe.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------	

}

//----------------------------------------------------------
// POST - UPDATE IMAGES PRO CATEGORIES
//----------------------------------------------------------

public function updateImagesPro_ZGFCP_Fami1_CR()
{	

	//update pro
	$backarray= $this->zgfcp_fami1bs->updateImagesPro_ZGFCP_Fami1_BS();

	if(isset($backarray) and $backarray['updateimagespro']=='1'){

	   return redirect()->route('zgfcp-fami1-images-update', ['zgfcp_fami1_id' => $backarray['zgfcp_fami1_id'],'zgfcp_fami1_token' => $backarray['zgfcp_fami1_token']]);
	}

   //--------------------------------------------------------------------------
	//error message
	$flash='La imagen no se pudo actualizar.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------				
}

//----------------------------------------------------------
// GET - DELETE IMAGES PRO CATEGORIES
//----------------------------------------------------------

public function deleteImagesPro_ZGFCP_Fami1_CR($zgfcp_fami1_id=null,$zgfcp_fami1_token=null,$image_number=null)
{	

   if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

      if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

      	if(isset($image_number) and is_numeric($image_number)){

				//delete image pro
				$deleteimagespro = $this->zgfcp_fami1bs->deleteImagesPro_ZGFCP_Fami1_BS($zgfcp_fami1_id,$zgfcp_fami1_token,$image_number);

				if(isset($deleteimagespro) and $deleteimagespro=='1'){

					return redirect()->route('zgfcp-fami1-images-update', ['zgfcp_fami1_id' => $zgfcp_fami1_id,'zgfcp_fami1_token' => $zgfcp_fami1_token]);			

				}

			}
		}

	}

	//--------------------------------------------------------------------------
	//error message
	$flash='La imagen no se pudo eliminar.';			
	return redirect()->route('zgfcp-fami1-list')->with('mal', $flash);
	//--------------------------------------------------------------------------
}

//----------------------------------------------------------
// ORDER CATEGORIES
//----------------------------------------------------------

public function order_ZGFCP_Fami1_CR()
{	

	$families= $this->zgfcp_fami1bs->getOrder_ZGFCP_Fami1_BS();

	if(isset($families) and $families->isNotEmpty()){

		return view('zgfcp_fami1.zgfcp_fami1_order',compact('families'));
	} 

	//--------------------------------------------------------------------------
	//error message
	$flash='No hay categorias, aqui puedes agregar los que necesitas';			
	return redirect()->route('zgfcp-fami1-insert')->with('mal', $flash);
	//--------------------------------------------------------------------------

}

//----------------------------------------------------------
//----------------------- ANGULAR ---------------------------
//----------------------------------------------------------

//----------------------------------------------------------
// ANGULAR POST - ORDER PRO CATEGORIES
//----------------------------------------------------------

public function orderPro_ZGFCP_Fami1_CR()
{	

	//order pro
	$backarray= $this->zgfcp_fami1bs->orderPro_ZGFCP_Fami1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
// ANGULAR POST - PUBLISH OR HIDDEN PRO CATEGORIES
//----------------------------------------------------------

public function publishPro_ZGFCP_Fami1_CR()
{	

	//publish pro
	$backarray= $this->zgfcp_fami1bs->publishPro_ZGFCP_Fami1_BS();	
		
   return $backarray;

}

//----------------------------------------------------------
} // end class