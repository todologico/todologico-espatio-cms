<?php

declare(strict_types=1);

namespace App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Cate1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\RXCP_Cate1_Data_QY;
use App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Cate1BS\RXCP_Cate1_Validation_BS;
use App\AppUtils\UploadUT;
use App\AppUtils\TokenUT;

//----------------------------------------------------------
// PRODUCTS PROD1 BUSINESS
//----------------------------------------------------------
// Class   : RXCP_Cate1_Main_BS
// Used by : RXCP_Cate1Controller
//----------------------------------------------------------
// get_RXCP_Cate1_BS
// getOrder_RXCP_Cate1_BS
// insertPro_RXCP_Cate1_BS
// update_RXCP_Cate1_BS
// updatePro_RXCP_Cate1_BS
// deletePro_RXCP_Cate1_BS
// clonePro_RXCP_Cate1_BS
// updateImagesPro_RXCP_Cate1_BS
// deleteImagesPro_RXCP_Cate1_BS
// publishHiddenPro_RXCP_Cate1_BS
// orderPro_RXCP_Cate1_BS
//----------------------------------------------------------

class RXCP_Cate1_Main_BS extends RXCP_Cate1_Data_QY
{

//----------------------------------------------------------
// CONSTRUCTOR
//----------------------------------------------------------

public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, RXCP_Cate1_Validation_BS $validatebs)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 
}

//----------------------------------------------------------
// LIST CATEGORIES CATE1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_RXCP_Cate1_BS()
{  

    $backarray['countprod1xcate1']=null;

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['rxcp_cate1_id','desc'];
    $backarray['categories']= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    $counting=count($backarray['categories']);
    
    If($counting > 0){

        //counting the products of each category
        $backarray['countprod1xcate1']= $this->countProductsCategories_RXCP_Cate1_QY(); 

    }
   
    return $backarray;     
}

//----------------------------------------------------------
// LIST ORDER PRODUCTS PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getOrder_RXCP_Cate1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['rxcp_cate1_enable','=','1']);  $orderby=['rxcp_cate1_order','asc'];
    $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $categories;     
}

//----------------------------------------------------------
// INSERT PRO PRODUCTS PROD1
// POST METHOD
// @param : form params
// @return: $rxcp_cate1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_RXCP_Cate1_BS()
{

    //two images for upload
    $onearray['rxcp_cate1_image1'] = null;
    $onearray['rxcp_cate1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_RXCP_Cate1_BS($this->request);

    $rxcp_cate1_category    = $this->request->Input("rxcp_cate1_category");
    $rxcp_cate1_title1      = $this->request->Input("rxcp_cate1_title1");
    $rxcp_cate1_title2      = $this->request->Input("rxcp_cate1_title2");
    $rxcp_cate1_enable      = $this->request->Input("rxcp_cate1_enable");    
    $rxcp_cate1_photo       = $this->request->file('rxcp_cate1_photo'); //files array

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$rxcp_cate1_photo,'rxcp_cate1_image');     

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $rxcp_cate1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array banner
    //---------------------------------------------------------- 

    $onearray['rxcp_cate1_category'] = $rxcp_cate1_category;
    $onearray['rxcp_cate1_title1'] = $rxcp_cate1_title1;
    $onearray['rxcp_cate1_title2'] = $rxcp_cate1_title2;
    $onearray['rxcp_cate1_enable'] = $rxcp_cate1_enable; 
    $onearray['rxcp_cate1_token']  = $rxcp_cate1_token; 

    $rxcp_cate1_id=$this->insert_RXCP_Cate1_QY($onearray);

    return $rxcp_cate1_id;   

}

//----------------------------------------------------------
// UPDATE FORM PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_RXCP_Cate1_BS($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{   
    $categories= null; 

    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

        //---------------------------------------------------------------
        $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
        $where=array(['rxcp_cate1_id','=',$rxcp_cate1_id],['rxcp_cate1_token','=',$rxcp_cate1_token]);
        $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $categories;  
}

//----------------------------------------------------------
// UPDATE DATA PRO PRODUCTS PROD1
// POST METHOD
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_RXCP_Cate1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_RXCP_Cate1_BS($this->request);

    $rxcp_cate1_id  = $this->request->Input("rxcp_cate1_id");
    $rxcp_cate1_token  = $this->request->Input("rxcp_cate1_token");
    $rxcp_cate1_category  = $this->request->Input("rxcp_cate1_category");
    $rxcp_cate1_title1  = $this->request->Input("rxcp_cate1_title1");
    $rxcp_cate1_title2  = $this->request->Input("rxcp_cate1_title2");
    $rxcp_cate1_enable  = $this->request->Input("rxcp_cate1_enable");    
    $rxcp_cate1_photo  = $this->request->file('rxcp_cate1_photo'); //files array

    // all the banner info
    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_cate1_id','=',$rxcp_cate1_id],['rxcp_cate1_token','=',$rxcp_cate1_token]);
            $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($categories[0]->rxcp_cate1_id)){ 

                //asign banner images to onearray
                $onearray['rxcp_cate1_image1'] = $categories[0]->rxcp_cate1_image1;
                $onearray['rxcp_cate1_image2'] = $categories[0]->rxcp_cate1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images rxcp_cate1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$rxcp_cate1_photo,'rxcp_cate1_image');     

                //----------------------------------------------------------
                // update array banner with text info
                //---------------------------------------------------------- 
               
                $onearray['rxcp_cate1_category']= $rxcp_cate1_category;
                $onearray['rxcp_cate1_title1']= $rxcp_cate1_title1;
                $onearray['rxcp_cate1_title2']= $rxcp_cate1_title2;
                $onearray['rxcp_cate1_enable']= $rxcp_cate1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_RXCP_Cate1_QY($onearray,$rxcp_cate1_id,$rxcp_cate1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_RXCP_Cate1_BS($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{

    $deletepro = null;
    
    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            $deletepro=$this->delete_RXCP_Cate1_QY($rxcp_cate1_id,$rxcp_cate1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_RXCP_Cate1_BS($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{   
    $clonepro= null; 

    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_cate1_id','=',$rxcp_cate1_id],['rxcp_cate1_token','=',$rxcp_cate1_token]);
            $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($categories[0]->rxcp_cate1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $rxcp_cate1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new banner
                //---------------------------------------------------------- 

                $onearray = [
                    'rxcp_cate1_category'=> $categories[0]->rxcp_cate1_category,
                    'rxcp_cate1_title1'=> $categories[0]->rxcp_cate1_title1,
                    'rxcp_cate1_title2'=> $categories[0]->rxcp_cate1_title2,
                    'rxcp_cate1_enable'=> 0,
                    'rxcp_cate1_image1'=> $categories[0]->rxcp_cate1_image1,
                    'rxcp_cate1_image2'=> $categories[0]->rxcp_cate1_image2,
                    'rxcp_cate1_token' => $rxcp_cate1_token,
                ];

                //rxcp_cate1_id
                $clonepro=$this->insert_RXCP_Cate1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO PRODUCTS PROD1
// POST METHOD
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_RXCP_Cate1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_RXCP_Cate1_BS($this->request);

    $backarray['rxcp_cate1_id']     = $this->request->Input("rxcp_cate1_id"); // array to routing
    $backarray['rxcp_cate1_token']  = $this->request->Input("rxcp_cate1_token"); // array to routing
    $rxcp_cate1_photo               = $this->request->file('rxcp_cate1_photo'); //files array

    // all the banner info
    if(isset($backarray['rxcp_cate1_id']) and is_numeric($backarray['rxcp_cate1_id'])){

        if(isset($backarray['rxcp_cate1_token']) and is_string($backarray['rxcp_cate1_token'])){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_cate1_id','=',$backarray['rxcp_cate1_id']],['rxcp_cate1_token','=',$backarray['rxcp_cate1_token']]);
            $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($categories[0]->rxcp_cate1_id)){ 

                //asign banner images to onearray
                $onearray['rxcp_cate1_image1'] = $categories[0]->rxcp_cate1_image1;
                $onearray['rxcp_cate1_image2'] = $categories[0]->rxcp_cate1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images rxcp_cate1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$rxcp_cate1_photo,'rxcp_cate1_image'); 

                //----------------------------------------------------------

                //1=ok or 0=error
                $updateimagespro=$this->update_RXCP_Cate1_QY($onearray,$backarray['rxcp_cate1_id'],$backarray['rxcp_cate1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
// DELETE IMAGES PRO PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_RXCP_Cate1_BS($rxcp_cate1_id=null,$rxcp_cate1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['rxcp_cate1_image1'] = null; }
                    if($image_number=='2'){ $onearray['rxcp_cate1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_RXCP_Cate1_QY($onearray,$rxcp_cate1_id,$rxcp_cate1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO PRODUCTS PROD1
// POST METHOD - ANGULAR JS
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_RXCP_Cate1_BS()
{

    $backarray['rxcp_cate1_id']  = null;
    $backarray['rxcp_cate1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $rxcp_cate1_id     = $this->request->Input("rxcp_cate1_id");
    $rxcp_cate1_token  = $this->request->Input("rxcp_cate1_token");
    $button      = $this->request->Input("button");

    // all the banner info
    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['rxcp_cate1_id','=',$rxcp_cate1_id],['rxcp_cate1_token','=',$rxcp_cate1_token]);
                $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($categories[0]->rxcp_cate1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['rxcp_cate1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['rxcp_cate1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_RXCP_Cate1_QY($onearray,$rxcp_cate1_id,$rxcp_cate1_token);

                    if($updatepro=='1'){

                        $backarray['rxcp_cate1_id']    = $rxcp_cate1_id;
                        $backarray['rxcp_cate1_token'] = $rxcp_cate1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
// ORDER PRO PRODUCTS PROD1
// POST METHOD - ANGULAR JS
// @param : $rxcp_cate1_id
// @param : $rxcp_cate1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_RXCP_Cate1_BS()
{

    $backarray['rxcp_cate1_id']  = null;
    $backarray['rxcp_cate1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $rxcp_cate1_id     = $this->request->Input("rxcp_cate1_id");
    $rxcp_cate1_token  = $this->request->Input("rxcp_cate1_token");
    $order       = $this->request->Input("order");

    // all the banner info
    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['rxcp_cate1_id','=',$rxcp_cate1_id],['rxcp_cate1_token','=',$rxcp_cate1_token]);
                $categories= $this->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($categories[0]->rxcp_cate1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['rxcp_cate1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_RXCP_Cate1_QY($onearray,$rxcp_cate1_id,$rxcp_cate1_token);

                    if($updatepro=='1'){

                        $backarray['rxcp_cate1_id']     = $rxcp_cate1_id;
                        $backarray['rxcp_cate1_token']  = $rxcp_cate1_token;
                    }
                                        
                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}