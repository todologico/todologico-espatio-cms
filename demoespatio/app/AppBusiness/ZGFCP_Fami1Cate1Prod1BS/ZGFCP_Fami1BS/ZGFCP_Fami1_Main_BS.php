<?php

declare(strict_types=1);

namespace App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Fami1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\ZGFCP_Fami1_Data_QY;
use App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Fami1BS\ZGFCP_Fami1_Validation_BS;
use App\AppUtils\UploadUT;
use App\AppUtils\TokenUT;

//----------------------------------------------------------
// FAMILIES FAMI1 BUSINESS
//----------------------------------------------------------
// Class   : ZGFCP_Fami1_Main_BS
// Used by : ZGFCP_Fami1Controller
//----------------------------------------------------------
// get_ZGFCP_Fami1_BS
// getOrder_ZGFCP_Fami1_BS
// insertPro_ZGFCP_Fami1_BS
// update_ZGFCP_Fami1_BS
// updatePro_ZGFCP_Fami1_BS
// deletePro_ZGFCP_Fami1_BS
// clonePro_ZGFCP_Fami1_BS
// updateImagesPro_ZGFCP_Fami1_BS
// deleteImagesPro_ZGFCP_Fami1_BS
// publishHiddenPro_ZGFCP_Fami1_BS
// orderPro_ZGFCP_Fami1_BS
//----------------------------------------------------------

class ZGFCP_Fami1_Main_BS extends ZGFCP_Fami1_Data_QY
{

//----------------------------------------------------------
// CONSTRUCTOR
//----------------------------------------------------------

public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, ZGFCP_Fami1_Validation_BS $validatebs)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 
}

//----------------------------------------------------------
// LIST FAMILIES FAMI1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_ZGFCP_Fami1_BS()
{  

    $backarray['countprod1xfami1']=null;   $backarray['countcate1xfami1']=null;

    //families---------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_fami1_id','desc'];
    $backarray['families']= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    $counting=count($backarray['families']);
    
     If($counting > 0){

        //counting the categories of each family
        $backarray['countcate1xfami1']= $this->countCategoriesxFamilies_ZGFCP_Fami1_QY(); 
        
        //counting the products of each family
        $backarray['countprod1xfami1']= $this->countProductsxFamilies_ZGFCP_Fami1_QY(); 

     }
   
    return $backarray;     
}

//----------------------------------------------------------
// LIST ORDER FAMILIES FAMI1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getOrder_ZGFCP_Fami1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_fami1_enable','=','1']);  $orderby=['zgfcp_fami1_order','asc'];
    $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $families;     
}

//----------------------------------------------------------
// INSERT PRO FAMILIES FAMI1
// POST METHOD
// @param : form params
// @return: $zgfcp_fami1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_ZGFCP_Fami1_BS()
{

    //two images for upload
    $onearray['zgfcp_fami1_image1'] = null;
    $onearray['zgfcp_fami1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_ZGFCP_Fami1_BS($this->request);

    $zgfcp_fami1_family   = $this->request->Input("zgfcp_fami1_family");
    $zgfcp_fami1_title1   = $this->request->Input("zgfcp_fami1_title1");
    $zgfcp_fami1_title2   = $this->request->Input("zgfcp_fami1_title2");
    $zgfcp_fami1_enable   = $this->request->Input("zgfcp_fami1_enable");    
    $zgfcp_fami1_photo    = $this->request->file('zgfcp_fami1_photo'); //files array

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_fami1_photo,'zgfcp_fami1_image');  

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $zgfcp_fami1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array family
    //---------------------------------------------------------- 

    $onearray['zgfcp_fami1_family'] = $zgfcp_fami1_family;
    $onearray['zgfcp_fami1_title1'] = $zgfcp_fami1_title1;
    $onearray['zgfcp_fami1_title2'] = $zgfcp_fami1_title2;
    $onearray['zgfcp_fami1_enable'] = $zgfcp_fami1_enable; 
    $onearray['zgfcp_fami1_token']  = $zgfcp_fami1_token; 

    $zgfcp_fami1_id=$this->insert_ZGFCP_Fami1_QY($onearray);

    return $zgfcp_fami1_id;   

}

//----------------------------------------------------------
// UPDATE FORM FAMILIES FAMI1
// GET METHOD
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_ZGFCP_Fami1_BS($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{   
    $families= null; 

    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

        //---------------------------------------------------------------
        $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
        $where=array(['zgfcp_fami1_id','=',$zgfcp_fami1_id],['zgfcp_fami1_token','=',$zgfcp_fami1_token]);
        $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $families;  
}

//----------------------------------------------------------
// UPDATE DATA PRO FAMILIES FAMI1
// POST METHOD
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_ZGFCP_Fami1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_ZGFCP_Fami1_BS($this->request);

    $zgfcp_fami1_id     = $this->request->Input("zgfcp_fami1_id");
    $zgfcp_fami1_token  = $this->request->Input("zgfcp_fami1_token");
    $zgfcp_fami1_family = $this->request->Input("zgfcp_fami1_family");
    $zgfcp_fami1_title1 = $this->request->Input("zgfcp_fami1_title1");
    $zgfcp_fami1_title2 = $this->request->Input("zgfcp_fami1_title2");
    $zgfcp_fami1_enable = $this->request->Input("zgfcp_fami1_enable");    
    $zgfcp_fami1_photo  = $this->request->file('zgfcp_fami1_photo'); //files array

    // all the family info
    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            //----------------------------------------------------------
            // family previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_fami1_id','=',$zgfcp_fami1_id],['zgfcp_fami1_token','=',$zgfcp_fami1_token]);
            $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($families[0]->zgfcp_fami1_id)){ 

                //asign family images to onearray
                $onearray['zgfcp_fami1_image1'] = $families[0]->zgfcp_fami1_image1;
                $onearray['zgfcp_fami1_image2'] = $families[0]->zgfcp_fami1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images zgfcp_fami1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_fami1_photo,'zgfcp_fami1_image');  

                //----------------------------------------------------------
                // update array family with text info
                //---------------------------------------------------------- 
               
                $onearray['zgfcp_fami1_family']= $zgfcp_fami1_family;
                $onearray['zgfcp_fami1_title1']= $zgfcp_fami1_title1;
                $onearray['zgfcp_fami1_title2']= $zgfcp_fami1_title2;
                $onearray['zgfcp_fami1_enable']= $zgfcp_fami1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_ZGFCP_Fami1_QY($onearray,$zgfcp_fami1_id,$zgfcp_fami1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO FAMILIES FAMI1
// GET METHOD
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_ZGFCP_Fami1_BS($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{

    $deletepro = null;
    
    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            $deletepro=$this->delete_ZGFCP_Fami1_QY($zgfcp_fami1_id,$zgfcp_fami1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM FAMILIES FAMI1
// GET METHOD
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_ZGFCP_Fami1_BS($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{   
    $clonepro= null; 

    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_fami1_id','=',$zgfcp_fami1_id],['zgfcp_fami1_token','=',$zgfcp_fami1_token]);
            $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($families[0]->zgfcp_fami1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $zgfcp_fami1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new family
                //---------------------------------------------------------- 

                $onearray = [
                    'zgfcp_fami1_family'=> $families[0]->zgfcp_fami1_family,
                    'zgfcp_fami1_title1'=> $families[0]->zgfcp_fami1_title1,
                    'zgfcp_fami1_title2'=> $families[0]->zgfcp_fami1_title2,
                    'zgfcp_fami1_enable'=> 0,
                    'zgfcp_fami1_image1'=> $families[0]->zgfcp_fami1_image1,
                    'zgfcp_fami1_image2'=> $families[0]->zgfcp_fami1_image2,
                    'zgfcp_fami1_token' => $zgfcp_fami1_token,
                ];

                //zgfcp_fami1_id
                $clonepro=$this->insert_ZGFCP_Fami1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO FAMILIES FAMI1
// POST METHOD
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_ZGFCP_Fami1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_ZGFCP_Fami1_BS($this->request);

    $backarray['zgfcp_fami1_id']     = $this->request->Input("zgfcp_fami1_id"); // array to routing
    $backarray['zgfcp_fami1_token']  = $this->request->Input("zgfcp_fami1_token"); // array to routing
    $zgfcp_fami1_photo               = $this->request->file('zgfcp_fami1_photo'); //files array

    // all the family info
    if(isset($backarray['zgfcp_fami1_id']) and is_numeric($backarray['zgfcp_fami1_id'])){

        if(isset($backarray['zgfcp_fami1_token']) and is_string($backarray['zgfcp_fami1_token'])){

            //----------------------------------------------------------
            // family previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_fami1_id','=',$backarray['zgfcp_fami1_id']],['zgfcp_fami1_token','=',$backarray['zgfcp_fami1_token']]);
            $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($families[0]->zgfcp_fami1_id)){ 

                //asign family images to onearray
                $onearray['zgfcp_fami1_image1'] = $families[0]->zgfcp_fami1_image1;
                $onearray['zgfcp_fami1_image2'] = $families[0]->zgfcp_fami1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images zgfcp_fami1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_fami1_photo,'zgfcp_fami1_image');              

                //1=ok or 0=error
                $updateimagespro=$this->update_ZGFCP_Fami1_QY($onearray,$backarray['zgfcp_fami1_id'],$backarray['zgfcp_fami1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
// DELETE IMAGES PRO FAMILIES FAMI1
// GET METHOD
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_ZGFCP_Fami1_BS($zgfcp_fami1_id=null,$zgfcp_fami1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['zgfcp_fami1_image1'] = null; }
                    if($image_number=='2'){ $onearray['zgfcp_fami1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_ZGFCP_Fami1_QY($onearray,$zgfcp_fami1_id,$zgfcp_fami1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO FAMILIES FAMI1
// POST METHOD - ANGULAR JS
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_ZGFCP_Fami1_BS()
{

    $backarray['zgfcp_fami1_id']  = null;
    $backarray['zgfcp_fami1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $zgfcp_fami1_id     = $this->request->Input("zgfcp_fami1_id");
    $zgfcp_fami1_token  = $this->request->Input("zgfcp_fami1_token");
    $button             = $this->request->Input("button");

    // all the family info
    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // family confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['zgfcp_fami1_id','=',$zgfcp_fami1_id],['zgfcp_fami1_token','=',$zgfcp_fami1_token]);
                $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($families[0]->zgfcp_fami1_id)){
             
                    //----------------------------------------------------------
                    // update array family with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['zgfcp_fami1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['zgfcp_fami1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_ZGFCP_Fami1_QY($onearray,$zgfcp_fami1_id,$zgfcp_fami1_token);

                    if($updatepro=='1'){

                        $backarray['zgfcp_fami1_id']    = $zgfcp_fami1_id;
                        $backarray['zgfcp_fami1_token'] = $zgfcp_fami1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
// ORDER PRO FAMILIES FAMI1
// POST METHOD - ANGULAR JS
// @param : $zgfcp_fami1_id
// @param : $zgfcp_fami1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_ZGFCP_Fami1_BS()
{

    $backarray['zgfcp_fami1_id']  = null;
    $backarray['zgfcp_fami1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $zgfcp_fami1_id     = $this->request->Input("zgfcp_fami1_id");
    $zgfcp_fami1_token  = $this->request->Input("zgfcp_fami1_token");
    $order              = $this->request->Input("order");

    // all the family info
    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // family confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['zgfcp_fami1_id','=',$zgfcp_fami1_id],['zgfcp_fami1_token','=',$zgfcp_fami1_token]);
                $families= $this->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($families[0]->zgfcp_fami1_id)){
             
                    //----------------------------------------------------------
                    // update array family with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['zgfcp_fami1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_ZGFCP_Fami1_QY($onearray,$zgfcp_fami1_id,$zgfcp_fami1_token);

                    if($updatepro=='1'){

                        $backarray['zgfcp_fami1_id']     = $zgfcp_fami1_id;
                        $backarray['zgfcp_fami1_token']  = $zgfcp_fami1_token;
                    }
                                        
                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}