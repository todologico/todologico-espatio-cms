<?php

declare(strict_types=1);

namespace App\AppBusiness\AAB_Bann1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\AAB_Bann1_Data_QY;
use App\AppBusiness\AAB_Bann1BS\AAB_Bann1_Validation_BS;
use App\AppUtils\TokenUT;
use App\AppUtils\UploadUT;


//----------------------------------------------------------
// BANNERS BUSINESS
//----------------------------------------------------------
// Class   : AAB_Bann1_Main_BS
// Used by : AAB_Bann1Controller
//----------------------------------------------------------
// get_AAB_Bann1_BS
// getOrder_AAB_Bann1_BS
// insertPro_AAB_Bann1_BS
// update_AAB_Bann1_BS
// updatePro_AAB_Bann1_BS
// deletePro_AAB_Bann1_BS
// clonePro_AAB_Bann1_BS
// updateImagesPro_AAB_Bann1_BS
// deleteImagesPro_AAB_Bann1_BS
// publishPro_AAB_Bann1_BS
// orderPro_AAB_Bann1_BS
//----------------------------------------------------------

class AAB_Bann1_Main_BS extends AAB_Bann1_Data_QY
{

public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, AAB_Bann1_Validation_BS $validatebs)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 

}

//----------------------------------------------------------
// LIST BANNERS
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_AAB_Bann1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['aab_bann1_id','desc'];
    $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $banners;     
}


//----------------------------------------------------------
// LIST ORDER BANNERS
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getOrder_AAB_Bann1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['aab_bann1_enable','=','1']);  $orderby=['aab_bann1_order','asc'];
    $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $banners;     
}

//----------------------------------------------------------
// INSERT PRO BANNERS
// POST METHOD
// @param : form params
// @return: $aab_bann1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_AAB_Bann1_BS()
{

    //two images for upload
    $onearray['aab_bann1_image1'] = null;
    $onearray['aab_bann1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_AAB_Bann1_BS($this->request);

    $aab_bann1_banner  = $this->request->Input("aab_bann1_banner");
    $aab_bann1_title1  = $this->request->Input("aab_bann1_title1");
    $aab_bann1_title2  = $this->request->Input("aab_bann1_title2");
    $aab_bann1_title3  = $this->request->Input("aab_bann1_title3");
    $aab_bann1_enable  = $this->request->Input("aab_bann1_enable");    
    $aab_bann1_photo   = $this->request->file('aab_bann1_photo'); //files array

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$aab_bann1_photo,'aab_bann1_image');    

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $aab_bann1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array banner
    //---------------------------------------------------------- 

    $onearray['aab_bann1_banner'] = $aab_bann1_banner;
    $onearray['aab_bann1_title1'] = $aab_bann1_title1;
    $onearray['aab_bann1_title2'] = $aab_bann1_title2;
    $onearray['aab_bann1_title3'] = $aab_bann1_title3;
    $onearray['aab_bann1_enable'] = $aab_bann1_enable; 
    $onearray['aab_bann1_token']  = $aab_bann1_token; 

    $aab_bann1_id=$this->insert_AAB_Bann1_QY($onearray);

    return $aab_bann1_id;   

}

//----------------------------------------------------------
// UPDATE FORM BANNERS
// GET METHOD
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_AAB_Bann1_BS($aab_bann1_id=null,$aab_bann1_token=null)
{   
    $banners= null; 

    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id))
    {

        if(isset($aab_bann1_token) and is_string($aab_bann1_token))
        {

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['aab_bann1_id','=',$aab_bann1_id],['aab_bann1_token','=',$aab_bann1_token]);
            $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $banners;  
}

//----------------------------------------------------------
// UPDATE DATA PRO BANNERS
// POST METHOD
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_AAB_Bann1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_AAB_Bann1_BS($this->request);

    $aab_bann1_id       = $this->request->Input("aab_bann1_id");
    $aab_bann1_token    = $this->request->Input("aab_bann1_token");
    $aab_bann1_banner   = $this->request->Input("aab_bann1_banner");
    $aab_bann1_title1   = $this->request->Input("aab_bann1_title1");
    $aab_bann1_title2   = $this->request->Input("aab_bann1_title2");
    $aab_bann1_title3   = $this->request->Input("aab_bann1_title3");
    $aab_bann1_enable   = $this->request->Input("aab_bann1_enable");    
    $aab_bann1_photo    = $this->request->file('aab_bann1_photo'); //files array

    // all the banner info
    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['aab_bann1_id','=',$aab_bann1_id],['aab_bann1_token','=',$aab_bann1_token]);
            $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($banners[0]->aab_bann1_id)){ 

                //asign banner images to onearray
                $onearray['aab_bann1_image1'] = $banners[0]->aab_bann1_image1;
                $onearray['aab_bann1_image2'] = $banners[0]->aab_bann1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images aab_bann1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$aab_bann1_photo,'aab_bann1_image');    

                //----------------------------------------------------------
                // update array banner with text info
                //---------------------------------------------------------- 
               
                $onearray['aab_bann1_banner']= $aab_bann1_banner;
                $onearray['aab_bann1_title1']= $aab_bann1_title1;
                $onearray['aab_bann1_title2']= $aab_bann1_title2;
                $onearray['aab_bann1_title3']= $aab_bann1_title3;
                $onearray['aab_bann1_enable']= $aab_bann1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_AAB_Bann1_QY($onearray,$aab_bann1_id,$aab_bann1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO BANNERS
// GET METHOD
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_AAB_Bann1_BS($aab_bann1_id=null,$aab_bann1_token=null)
{

    $deletepro = null;
    
    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            $deletepro=$this->delete_AAB_Bann1_QY($aab_bann1_id,$aab_bann1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM BANNERS
// GET METHOD
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_AAB_Bann1_BS($aab_bann1_id=null,$aab_bann1_token=null)
{   
    $clonepro= null; 

    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['aab_bann1_id','=',$aab_bann1_id],['aab_bann1_token','=',$aab_bann1_token]);
            $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($banners[0]->aab_bann1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $aab_bann1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new banner
                //---------------------------------------------------------- 

                $onearray = [
                    'aab_bann1_banner'=> $banners[0]->aab_bann1_banner,
                    'aab_bann1_title1'=> $banners[0]->aab_bann1_title1,
                    'aab_bann1_title2'=> $banners[0]->aab_bann1_title2,
                    'aab_bann1_title3'=> $banners[0]->aab_bann1_title3,
                    'aab_bann1_enable'=> 0,
                    'aab_bann1_image1'=> $banners[0]->aab_bann1_image1,
                    'aab_bann1_image2'=> $banners[0]->aab_bann1_image2,
                    'aab_bann1_token' => $aab_bann1_token,
                ];

                //aab_bann1_id
                $clonepro=$this->insert_AAB_Bann1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO BANNERS
// POST METHOD
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_AAB_Bann1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_AAB_Bann1_BS($this->request);

    $backarray['aab_bann1_id']     = $this->request->Input("aab_bann1_id"); // array to routing
    $backarray['aab_bann1_token']  = $this->request->Input("aab_bann1_token"); // array to routing
    $aab_bann1_photo               = $this->request->file('aab_bann1_photo'); //files array

    // all the banner info
    if(isset($backarray['aab_bann1_id']) and is_numeric($backarray['aab_bann1_id'])){

        if(isset($backarray['aab_bann1_token']) and is_string($backarray['aab_bann1_token'])){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['aab_bann1_id','=',$backarray['aab_bann1_id']],['aab_bann1_token','=',$backarray['aab_bann1_token']]);
            $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($banners[0]->aab_bann1_id)){ 

                //asign banner images to onearray
                $onearray['aab_bann1_image1'] = $banners[0]->aab_bann1_image1;
                $onearray['aab_bann1_image2'] = $banners[0]->aab_bann1_image2;


                //----------------------------------------------------------
                // to upload images, if there are no images aab_bann1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$aab_bann1_photo,'aab_bann1_image');    
            
                //----------------------------------------------------------

                //1=ok or 0=error
                $updateimagespro=$this->update_AAB_Bann1_QY($onearray,$backarray['aab_bann1_id'],$backarray['aab_bann1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
// DELETE IMAGES PRO BANNERS
// GET METHOD
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_AAB_Bann1_BS($aab_bann1_id=null,$aab_bann1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['aab_bann1_image1'] = null; }
                    if($image_number=='2'){ $onearray['aab_bann1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_AAB_Bann1_QY($onearray,$aab_bann1_id,$aab_bann1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO BANNERS
// POST METHOD - ANGULAR JS
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_AAB_Bann1_BS()
{

    $backarray['aab_bann1_id']      = null;
    $backarray['aab_bann1_token']   = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $aab_bann1_id       = $this->request->Input("aab_bann1_id");
    $aab_bann1_token    = $this->request->Input("aab_bann1_token");
    $button             = $this->request->Input("button");

    // all the banner info
    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['aab_bann1_id','=',$aab_bann1_id],['aab_bann1_token','=',$aab_bann1_token]);
                $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($banners[0]->aab_bann1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['aab_bann1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['aab_bann1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_AAB_Bann1_QY($onearray,$aab_bann1_id,$aab_bann1_token);

                    if($updatepro=='1'){

                        $backarray['aab_bann1_id']    = $aab_bann1_id;
                        $backarray['aab_bann1_token'] = $aab_bann1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
// ORDER PRO BANNERS
// POST METHOD - ANGULAR JS
// @param : $aab_bann1_id
// @param : $aab_bann1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_AAB_Bann1_BS()
{

    $backarray['aab_bann1_id']  = null;
    $backarray['aab_bann1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $aab_bann1_id       = $this->request->Input("aab_bann1_id");
    $aab_bann1_token    = $this->request->Input("aab_bann1_token");
    $order              = $this->request->Input("order");

    // all the banner info
    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['aab_bann1_id','=',$aab_bann1_id],['aab_bann1_token','=',$aab_bann1_token]);
                $banners= $this->get_AAB_Bann1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($banners[0]->aab_bann1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['aab_bann1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_AAB_Bann1_QY($onearray,$aab_bann1_id,$aab_bann1_token);

                    if($updatepro=='1'){

                        $backarray['aab_bann1_id']     = $aab_bann1_id;
                        $backarray['aab_bann1_token']  = $aab_bann1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}