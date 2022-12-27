<?php
declare(strict_types=1);

namespace App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Cate1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\ZGFCP_Cate1_Data_QY;
use App\AppQuerys\ZGFCP_Fami1_Data_QY;

use App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Cate1BS\ZGFCP_Cate1_Validation_BS;
use App\AppUtils\UploadUT;
use App\AppUtils\TokenUT;

//----------------------------------------------------------
// PRODUCTS PROD1 BUSINESS
//----------------------------------------------------------
// Class   : ZGFCP_Cate1_Main_BS
// Used by : ZGFCP_Cate1Controller
//----------------------------------------------------------
// get_ZGFCP_Cate1_BS
// getOrder_ZGFCP_Cate1_BS
// insertPro_ZGFCP_Cate1_BS
// update_ZGFCP_Cate1_BS
// updatePro_ZGFCP_Cate1_BS
// deletePro_ZGFCP_Cate1_BS
// clonePro_ZGFCP_Cate1_BS
// updateImagesPro_ZGFCP_Cate1_BS
// deleteImagesPro_ZGFCP_Cate1_BS
// publishHiddenPro_ZGFCP_Cate1_BS
// orderPro_ZGFCP_Cate1_BS
//----------------------------------------------------------

class ZGFCP_Cate1_Main_BS extends ZGFCP_Cate1_Data_QY
{

//----------------------------------------------------------
// CONSTRUCTOR
//----------------------------------------------------------

public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, ZGFCP_Cate1_Validation_BS $validatebs, ZGFCP_Fami1_Data_QY $zgfcp_fami1qy)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 
   $this->zgfcp_fami1qy=$zgfcp_fami1qy; 
}

//----------------------------------------------------------
// LIST CATEGORIES CATE1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_ZGFCP_Cate1_BS()
{  
    //families -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_fami1_family','asc'];  
    $backarray['families']= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  
      
    //categories----------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_cate1_fami1_id','desc'];
    $backarray['categories']= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    $counting=count($backarray['categories']);
    
    If($counting > 0){

        //counting the products of each category
        $backarray['countprod1xcate1']= $this->countProductsxCategories_ZGFCP_Cate1_QY(); 

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

public function getOrder_ZGFCP_Cate1_BS()
{  

    //categories----------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_cate1_enable','=','1']);  $orderby=['zgfcp_cate1_order','asc'];
    $categories= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $categories;     
}

//----------------------------------------------------------
// INSERT CATEGORIES CATE1
// POST METHOD
// @param : form params
// @return: $zgfcp_cate1_id
// @return: null 
//----------------------------------------------------------

public function insert_ZGFCP_Cate1_BS()
{

    //families -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_fami1_enable','=','1']);  $orderby=['zgfcp_fami1_family','asc'];      
    $families= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit); 
    
    return $families;

}

//----------------------------------------------------------
// INSERT CATEGORIES CATE1 PRO
// POST METHOD
// @param : form params
// @return: $zgfcp_cate1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_ZGFCP_Cate1_BS()
{

    //two images for upload
    $onearray['zgfcp_cate1_image1'] = null;
    $onearray['zgfcp_cate1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_ZGFCP_Cate1_BS($this->request);

    $zgfcp_cate1_fami1_id    = $this->request->Input("zgfcp_cate1_fami1_id");
    $zgfcp_cate1_category    = $this->request->Input("zgfcp_cate1_category");
    $zgfcp_cate1_title1      = $this->request->Input("zgfcp_cate1_title1");
    $zgfcp_cate1_title2      = $this->request->Input("zgfcp_cate1_title2");
    $zgfcp_cate1_enable      = $this->request->Input("zgfcp_cate1_enable");    
    $zgfcp_cate1_photo       = $this->request->file('zgfcp_cate1_photo'); //files array

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_cate1_photo,'zgfcp_cate1_image');  

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $zgfcp_cate1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array banner
    //---------------------------------------------------------- 

    $onearray['zgfcp_cate1_fami1_id']   = $zgfcp_cate1_fami1_id;
    $onearray['zgfcp_cate1_category']   = $zgfcp_cate1_category;
    $onearray['zgfcp_cate1_title1']     = $zgfcp_cate1_title1;
    $onearray['zgfcp_cate1_title2']     = $zgfcp_cate1_title2;
    $onearray['zgfcp_cate1_enable']     = $zgfcp_cate1_enable; 
    $onearray['zgfcp_cate1_token']      = $zgfcp_cate1_token; 

    $zgfcp_cate1_id=$this->insert_ZGFCP_Cate1_QY($onearray);

    return $zgfcp_cate1_id;   

}

//----------------------------------------------------------
// UPDATE FORM PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_ZGFCP_Cate1_BS($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{   
    $backarray= null; 

    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            //families -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_fami1_enable','=','1']);  $orderby=['zgfcp_fami1_family','asc'];            
            $backarray['families']= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            //categories---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_id','=',$zgfcp_cate1_id],['zgfcp_cate1_token','=',$zgfcp_cate1_token]);
            $backarray['categories']= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $backarray;  
}

//----------------------------------------------------------
// UPDATE DATA PRO PRODUCTS PROD1
// POST METHOD
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_ZGFCP_Cate1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_ZGFCP_Cate1_BS($this->request);

    $zgfcp_cate1_id         = $this->request->Input("zgfcp_cate1_id");
    $zgfcp_cate1_token      = $this->request->Input("zgfcp_cate1_token");
    $zgfcp_cate1_fami1_id   = $this->request->Input("zgfcp_cate1_fami1_id");
    $zgfcp_cate1_category   = $this->request->Input("zgfcp_cate1_category");
    $zgfcp_cate1_title1     = $this->request->Input("zgfcp_cate1_title1");
    $zgfcp_cate1_title2     = $this->request->Input("zgfcp_cate1_title2");
    $zgfcp_cate1_enable     = $this->request->Input("zgfcp_cate1_enable");    
    $zgfcp_cate1_photo      = $this->request->file('zgfcp_cate1_photo'); //files array

    // all the banner info
    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_id','=',$zgfcp_cate1_id],['zgfcp_cate1_token','=',$zgfcp_cate1_token]);
            $categories= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($categories[0]->zgfcp_cate1_id)){ 

                //asign banner images to onearray
                $onearray['zgfcp_cate1_image1'] = $categories[0]->zgfcp_cate1_image1;
                $onearray['zgfcp_cate1_image2'] = $categories[0]->zgfcp_cate1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images zgfcp_cate1_photo == null,  to images $onearray
                //----------------------------------------------------------
                
                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_cate1_photo,'zgfcp_cate1_image');  

                //----------------------------------------------------------
                // update array banner with text info
                //---------------------------------------------------------- 
               
                $onearray['zgfcp_cate1_fami1_id']   = $zgfcp_cate1_fami1_id;
                $onearray['zgfcp_cate1_category']   = $zgfcp_cate1_category;
                $onearray['zgfcp_cate1_title1']     = $zgfcp_cate1_title1;
                $onearray['zgfcp_cate1_title2']     = $zgfcp_cate1_title2;
                $onearray['zgfcp_cate1_enable']     = $zgfcp_cate1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_ZGFCP_Cate1_QY($onearray,$zgfcp_cate1_id,$zgfcp_cate1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_ZGFCP_Cate1_BS($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{

    $deletepro = null;
    
    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            $deletepro=$this->delete_ZGFCP_Cate1_QY($zgfcp_cate1_id,$zgfcp_cate1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_ZGFCP_Cate1_BS($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{   
    $clonepro= null; 

    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_id','=',$zgfcp_cate1_id],['zgfcp_cate1_token','=',$zgfcp_cate1_token]);
            $categories= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($categories[0]->zgfcp_cate1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $zgfcp_cate1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new banner
                //---------------------------------------------------------- 

                $onearray = [
                    'zgfcp_cate1_fami1_id'  => $categories[0]->zgfcp_cate1_fami1_id,
                    'zgfcp_cate1_category'  => $categories[0]->zgfcp_cate1_category,
                    'zgfcp_cate1_title1'    => $categories[0]->zgfcp_cate1_title1,
                    'zgfcp_cate1_title2'    => $categories[0]->zgfcp_cate1_title2,
                    'zgfcp_cate1_enable'    => 0,
                    'zgfcp_cate1_image1'    => $categories[0]->zgfcp_cate1_image1,
                    'zgfcp_cate1_image2'    => $categories[0]->zgfcp_cate1_image2,
                    'zgfcp_cate1_token'     => $zgfcp_cate1_token,
                ];

                //zgfcp_cate1_id
                $clonepro=$this->insert_ZGFCP_Cate1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO PRODUCTS PROD1
// POST METHOD
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_ZGFCP_Cate1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_ZGFCP_Cate1_BS($this->request);

    $backarray['zgfcp_cate1_id']     = $this->request->Input("zgfcp_cate1_id"); // array to routing
    $backarray['zgfcp_cate1_token']  = $this->request->Input("zgfcp_cate1_token"); // array to routing
    $zgfcp_cate1_photo               = $this->request->file('zgfcp_cate1_photo'); //files array

    // all the banner info
    if(isset($backarray['zgfcp_cate1_id']) and is_numeric($backarray['zgfcp_cate1_id'])){

        if(isset($backarray['zgfcp_cate1_token']) and is_string($backarray['zgfcp_cate1_token'])){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_id','=',$backarray['zgfcp_cate1_id']],['zgfcp_cate1_token','=',$backarray['zgfcp_cate1_token']]);
            $categories= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($categories[0]->zgfcp_cate1_id)){ 

                //asign banner images to onearray
                $onearray['zgfcp_cate1_image1'] = $categories[0]->zgfcp_cate1_image1;
                $onearray['zgfcp_cate1_image2'] = $categories[0]->zgfcp_cate1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images zgfcp_cate1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_cate1_photo,'zgfcp_cate1_image');                

                //1=ok or 0=error
                $updateimagespro=$this->update_ZGFCP_Cate1_QY($onearray,$backarray['zgfcp_cate1_id'],$backarray['zgfcp_cate1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}


//----------------------------------------------------------
// DELETE IMAGES PRO PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_ZGFCP_Cate1_BS($zgfcp_cate1_id=null,$zgfcp_cate1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['zgfcp_cate1_image1'] = null; }
                    if($image_number=='2'){ $onearray['zgfcp_cate1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_ZGFCP_Cate1_QY($onearray,$zgfcp_cate1_id,$zgfcp_cate1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO PRODUCTS PROD1
// POST METHOD - ANGULAR JS
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_ZGFCP_Cate1_BS()
{

    $backarray['zgfcp_cate1_id']  = null;
    $backarray['zgfcp_cate1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $zgfcp_cate1_id     = $this->request->Input("zgfcp_cate1_id");
    $zgfcp_cate1_token  = $this->request->Input("zgfcp_cate1_token");
    $button             = $this->request->Input("button");

    // all the banner info
    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['zgfcp_cate1_id','=',$zgfcp_cate1_id],['zgfcp_cate1_token','=',$zgfcp_cate1_token]);
                $categories= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($categories[0]->zgfcp_cate1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['zgfcp_cate1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['zgfcp_cate1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_ZGFCP_Cate1_QY($onearray,$zgfcp_cate1_id,$zgfcp_cate1_token);

                    if($updatepro=='1'){

                        $backarray['zgfcp_cate1_id']    = $zgfcp_cate1_id;
                        $backarray['zgfcp_cate1_token'] = $zgfcp_cate1_token;
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
// @param : $zgfcp_cate1_id
// @param : $zgfcp_cate1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_ZGFCP_Cate1_BS()
{

    $backarray['zgfcp_cate1_id']  = null;
    $backarray['zgfcp_cate1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $zgfcp_cate1_id     = $this->request->Input("zgfcp_cate1_id");
    $zgfcp_cate1_token  = $this->request->Input("zgfcp_cate1_token");
    $order              = $this->request->Input("order");

    // all the banner info
    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['zgfcp_cate1_id','=',$zgfcp_cate1_id],['zgfcp_cate1_token','=',$zgfcp_cate1_token]);
                $categories= $this->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($categories[0]->zgfcp_cate1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['zgfcp_cate1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_ZGFCP_Cate1_QY($onearray,$zgfcp_cate1_id,$zgfcp_cate1_token);

                    if($updatepro=='1'){

                        $backarray['zgfcp_cate1_id']     = $zgfcp_cate1_id;
                        $backarray['zgfcp_cate1_token']  = $zgfcp_cate1_token;
                    }
                                        
                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}