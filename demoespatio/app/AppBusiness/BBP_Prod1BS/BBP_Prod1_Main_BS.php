<?php

declare(strict_types=1);

namespace App\AppBusiness\BBP_Prod1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\BBP_Prod1_Data_QY;
use App\AppBusiness\BBP_Prod1BS\BBP_Prod1_Validation_BS;
use App\AppUtils\UploadUT;
use App\AppUtils\TokenUT;

//----------------------------------------------------------
// PRODUCTS PROD1 BUSINESS
//----------------------------------------------------------
// Class   : BBP_Prod1_Main_BS
// Used by : BBP_Prod1Controller
//----------------------------------------------------------
// get_BBP_Prod1_BS
// getSearch_BBP_Prod1_BS
// getOrder_BBP_Prod1_BS
// insertPro_BBP_Prod1_BS
// update_BBP_Prod1_BS
// updatePro_BBP_Prod1_BS
// deletePro_BBP_Prod1_BS
// clonePro_BBP_Prod1_BS
// updateImagesPro_BBP_Prod1_BS
// deleteImagesPro_BBP_Prod1_BS
// publishPro_BBP_Prod1_BS
// orderPro_BBP_Prod1_BS
//----------------------------------------------------------

class BBP_Prod1_Main_BS extends BBP_Prod1_Data_QY
{

public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, BBP_Prod1_Validation_BS $validatebs)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 
}

//----------------------------------------------------------
// LIST PRODUCTS PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_BBP_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['bbp_prod1_id','desc']; $paginate=20;
    $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $products;     
}

//----------------------------------------------------------
// SEARCH LIST PRODUCTS BBP_Prod1_BS
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearch_BBP_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['bbp_prod1_id','desc']; $paginate=20;

    //-----------------------
    //determine if a value is present on the request and is not an empty string
    if ($this->request->filled('bbp_prod1_txtsearch')) {


        $bbp_prod1_txtsearch = $this->request->Input("bbp_prod1_txtsearch");
        $mytext='%'.$bbp_prod1_txtsearch.'%';                                       
        $orwhere=array(['bbp_prod1_id','=',$bbp_prod1_txtsearch],['bbp_prod1_product','like',$mytext],['bbp_prod1_code','like',$mytext]); 
                   
    } 

    $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 


    return $products;     
}

//----------------------------------------------------------
// LIST ORDER PRODUCTS PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getOrder_BBP_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['bbp_prod1_enable','=','1']);  $orderby=['bbp_prod1_order','asc'];
    $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $products;     
}

//----------------------------------------------------------
// INSERT PRO PRODUCTS PROD1
// POST METHOD
// @param : form params
// @return: $bbp_prod1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_BBP_Prod1_BS()
{

    //two images for upload
    $onearray['bbp_prod1_image1'] = null;
    $onearray['bbp_prod1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_BBP_Prod1_BS($this->request);

    $bbp_prod1_product  = $this->request->Input("bbp_prod1_product");
    $bbp_prod1_code     = $this->request->Input("bbp_prod1_code");
    $bbp_prod1_price1   = $this->request->Input("bbp_prod1_price1");
    $bbp_prod1_title1   = $this->request->Input("bbp_prod1_title1");
    $bbp_prod1_title2   = $this->request->Input("bbp_prod1_title2");
    $bbp_prod1_title3   = $this->request->Input("bbp_prod1_title3");
    $bbp_prod1_enable   = $this->request->Input("bbp_prod1_enable");    
    $bbp_prod1_photo    = $this->request->file('bbp_prod1_photo'); //files array

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    if ($this->request->has('bbp_prod1_photo')) {

        $onearray= $this->uploadut->UploadArrayImageUT($onearray,$bbp_prod1_photo,'bbp_prod1_image');  

    }

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $bbp_prod1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array banner
    //---------------------------------------------------------- 

    $onearray['bbp_prod1_product']  = $bbp_prod1_product;
    $onearray['bbp_prod1_code']     = $bbp_prod1_code;
    $onearray['bbp_prod1_price1']   = $bbp_prod1_price1;
    $onearray['bbp_prod1_title1']   = $bbp_prod1_title1;
    $onearray['bbp_prod1_title2']   = $bbp_prod1_title2;
    $onearray['bbp_prod1_title3']   = $bbp_prod1_title3;
    $onearray['bbp_prod1_enable']   = $bbp_prod1_enable; 
    $onearray['bbp_prod1_token']    = $bbp_prod1_token; 

    $bbp_prod1_id=$this->insert_BBP_Prod1_QY($onearray);

    return $bbp_prod1_id;   

}

//----------------------------------------------------------
// UPDATE FORM PRODUCTS PROD1
// GET METHOD
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_BBP_Prod1_BS($bbp_prod1_id=null,$bbp_prod1_token=null)
{   
    $products= null; 

    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

        //---------------------------------------------------------------
        $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
        $where=array(['bbp_prod1_id','=',$bbp_prod1_id],['bbp_prod1_token','=',$bbp_prod1_token]);
        $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $products;  
}

//----------------------------------------------------------
// UPDATE DATA PRO PRODUCTS PROD1
// POST METHOD
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_BBP_Prod1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_BBP_Prod1_BS($this->request);

    $bbp_prod1_id       = $this->request->Input("bbp_prod1_id");
    $bbp_prod1_token    = $this->request->Input("bbp_prod1_token");
    $bbp_prod1_product  = $this->request->Input("bbp_prod1_product");
    $bbp_prod1_code     = $this->request->Input("bbp_prod1_code");
    $bbp_prod1_price1   = $this->request->Input("bbp_prod1_price1");
    $bbp_prod1_title1   = $this->request->Input("bbp_prod1_title1");
    $bbp_prod1_title2   = $this->request->Input("bbp_prod1_title2");
    $bbp_prod1_title3   = $this->request->Input("bbp_prod1_title3");
    $bbp_prod1_enable   = $this->request->Input("bbp_prod1_enable");    
    $bbp_prod1_photo    = $this->request->file('bbp_prod1_photo'); //files array

    // all the banner info
    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['bbp_prod1_id','=',$bbp_prod1_id],['bbp_prod1_token','=',$bbp_prod1_token]);
            $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($products[0]->bbp_prod1_id)){ 

                //asign banner images to onearray
                $onearray['bbp_prod1_image1'] = $products[0]->bbp_prod1_image1;
                $onearray['bbp_prod1_image2'] = $products[0]->bbp_prod1_image2;
 
                //----------------------------------------------------------
                // to upload images
                //----------------------------------------------------------

                if ($this->request->has('bbp_prod1_photo')) {

                    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$bbp_prod1_photo,'bbp_prod1_image');  
                }

                //----------------------------------------------------------
                // update array banner with text info
                //---------------------------------------------------------- 
               
                $onearray['bbp_prod1_product']  = $bbp_prod1_product;
                $onearray['bbp_prod1_code']     = $bbp_prod1_code;
                $onearray['bbp_prod1_price1']   = $bbp_prod1_price1;
                $onearray['bbp_prod1_title1']   = $bbp_prod1_title1;
                $onearray['bbp_prod1_title2']   = $bbp_prod1_title2;
                $onearray['bbp_prod1_title3']   = $bbp_prod1_title3;
                $onearray['bbp_prod1_enable']   = $bbp_prod1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_BBP_Prod1_QY($onearray,$bbp_prod1_id,$bbp_prod1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO PRODUCTS PROD1
// GET METHOD
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_BBP_Prod1_BS($bbp_prod1_id=null,$bbp_prod1_token=null)
{

    $deletepro = null;
    
    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            $deletepro=$this->delete_BBP_Prod1_QY($bbp_prod1_id,$bbp_prod1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM PRODUCTS PROD1
// GET METHOD
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_BBP_Prod1_BS($bbp_prod1_id=null,$bbp_prod1_token=null)
{   
    $clonepro= null; 

    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['bbp_prod1_id','=',$bbp_prod1_id],['bbp_prod1_token','=',$bbp_prod1_token]);
            $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($products[0]->bbp_prod1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $bbp_prod1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new banner
                //---------------------------------------------------------- 

                $onearray = [
                    'bbp_prod1_product' => $products[0]->bbp_prod1_product,
                    'bbp_prod1_code'    => $products[0]->bbp_prod1_code,
                    'bbp_prod1_price1'  => $products[0]->bbp_prod1_price1,
                    'bbp_prod1_title1'  => $products[0]->bbp_prod1_title1,
                    'bbp_prod1_title2'  => $products[0]->bbp_prod1_title2,
                    'bbp_prod1_title3'  => $products[0]->bbp_prod1_title3,
                    'bbp_prod1_enable'  => 0,
                    'bbp_prod1_image1'  => $products[0]->bbp_prod1_image1,
                    'bbp_prod1_image2'  => $products[0]->bbp_prod1_image2,
                    'bbp_prod1_token'   => $bbp_prod1_token,
                ];

                //bbp_prod1_id
                $clonepro=$this->insert_BBP_Prod1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO PRODUCTS PROD1
// POST METHOD
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_BBP_Prod1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_BBP_Prod1_BS($this->request);

    $backarray['bbp_prod1_id']     = $this->request->Input("bbp_prod1_id"); // array to routing
    $backarray['bbp_prod1_token']  = $this->request->Input("bbp_prod1_token"); // array to routing
    $bbp_prod1_photo               = $this->request->file('bbp_prod1_photo'); //files array

    // all the banner info
    if(isset($backarray['bbp_prod1_id']) and is_numeric($backarray['bbp_prod1_id'])){

        if(isset($backarray['bbp_prod1_token']) and is_string($backarray['bbp_prod1_token'])){

            //----------------------------------------------------------
            // banner previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['bbp_prod1_id','=',$backarray['bbp_prod1_id']],['bbp_prod1_token','=',$backarray['bbp_prod1_token']]);
            $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($products[0]->bbp_prod1_id)){ 

                //asign banner images to onearray
                $onearray['bbp_prod1_image1'] = $products[0]->bbp_prod1_image1;
                $onearray['bbp_prod1_image2'] = $products[0]->bbp_prod1_image2;
        
                //----------------------------------------------------------
                // to upload images
                //----------------------------------------------------------

                if ($this->request->has('bbp_prod1_photo')) {

                    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$bbp_prod1_photo,'bbp_prod1_image');              

                }

                //1=ok or 0=error
                $updateimagespro=$this->update_BBP_Prod1_QY($onearray,$backarray['bbp_prod1_id'],$backarray['bbp_prod1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}


//----------------------------------------------------------
// DELETE IMAGES PRO PRODUCTS PROD1
// GET METHOD
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_BBP_Prod1_BS($bbp_prod1_id=null,$bbp_prod1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['bbp_prod1_image1'] = null; }
                    if($image_number=='2'){ $onearray['bbp_prod1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_BBP_Prod1_QY($onearray,$bbp_prod1_id,$bbp_prod1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO PRODUCTS PROD1
// POST METHOD - ANGULAR JS
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_BBP_Prod1_BS()
{

    $backarray['bbp_prod1_id']  = null;
    $backarray['bbp_prod1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $bbp_prod1_id     = $this->request->Input("bbp_prod1_id");
    $bbp_prod1_token  = $this->request->Input("bbp_prod1_token");
    $button      = $this->request->Input("button");

    // all the banner info
    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['bbp_prod1_id','=',$bbp_prod1_id],['bbp_prod1_token','=',$bbp_prod1_token]);
                $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($products[0]->bbp_prod1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['bbp_prod1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['bbp_prod1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_BBP_Prod1_QY($onearray,$bbp_prod1_id,$bbp_prod1_token);

                    if($updatepro=='1'){

                        $backarray['bbp_prod1_id']    = $bbp_prod1_id;
                        $backarray['bbp_prod1_token'] = $bbp_prod1_token;
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
// @param : $bbp_prod1_id
// @param : $bbp_prod1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_BBP_Prod1_BS()
{

    $backarray['bbp_prod1_id']  = null;
    $backarray['bbp_prod1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $bbp_prod1_id     = $this->request->Input("bbp_prod1_id");
    $bbp_prod1_token  = $this->request->Input("bbp_prod1_token");
    $order            = $this->request->Input("order");

    // all the banner info
    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // banner confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['bbp_prod1_id','=',$bbp_prod1_id],['bbp_prod1_token','=',$bbp_prod1_token]);
                $products= $this->get_BBP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($products[0]->bbp_prod1_id)){
             
                    //----------------------------------------------------------
                    // update array banner with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['bbp_prod1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_BBP_Prod1_QY($onearray,$bbp_prod1_id,$bbp_prod1_token);

                    if($updatepro=='1'){

                        $backarray['bbp_prod1_id']     = $bbp_prod1_id;
                        $backarray['bbp_prod1_token']  = $bbp_prod1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}