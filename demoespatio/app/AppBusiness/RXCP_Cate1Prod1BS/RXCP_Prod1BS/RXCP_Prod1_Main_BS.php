<?php

declare(strict_types=1);

namespace App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Prod1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\RXCP_Cate1_Data_QY;
use App\AppQuerys\RXCP_Prod1_Data_QY;
use App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Prod1BS\RXCP_Prod1_Validation_BS;

use App\AppUtils\UploadUT;
use App\AppUtils\TokenUT;

//----------------------------------------------------------
// PRODUCTS PROD1 BUSINESS
//----------------------------------------------------------
// Class   : RXCP_Prod1_Main_BS
// Used by : RXCP_Prod1Controller
//----------------------------------------------------------
// get_RXCP_Prod1_BS
// getSearch_RXCP_Prod1_BS
// getSearchLink_RXCP_Prod1_BS
// getOrder_RXCP_Prod1_BS
// insert_RXCP_Prod1_BS
// insertPro_RXCP_Prod1_BS
// update_RXCP_Prod1_BS
// updatePro_RXCP_Prod1_BS
// deletePro_RXCP_Prod1_BS
// clonePro_RXCP_Prod1_BS
// updateImagesPro_RXCP_Prod1_BS
// deleteImagesPro_RXCP_Prod1_BS
// publishPro_RXCP_Prod1_BS
// orderPro_RXCP_Prod1_BS
//----------------------------------------------------------

class RXCP_Prod1_Main_BS extends RXCP_Prod1_Data_QY
{


public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, RXCP_Prod1_Validation_BS $validatebs,RXCP_Cate1_Data_QY $rxcp_cate1qy)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 
   $this->rxcp_cate1qy=$rxcp_cate1qy; 
}

//----------------------------------------------------------
// LIST PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_RXCP_Prod1_BS()
{  

    //categories -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['rxcp_cate1_category','asc'];
    $backarray['categories']= $this->rxcp_cate1qy->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  
    
    //products------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['rxcp_prod1_id','desc']; $paginate=100;
    $backarray['products']= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $backarray;     
}

//----------------------------------------------------------
// SEARCH LIST PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearch_RXCP_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['rxcp_prod1_id','desc']; $paginate=20;
    $rxcp_cate1_id = $this->request->Input("rxcp_cate1_id");

    //-----------------------
    //category search
    if(isset($rxcp_cate1_id) and $rxcp_cate1_id <> '0'){        

       $where=array(['rxcp_prod1_cate1_id','=',$rxcp_cate1_id]);
    } 

    //-----------------------
    //determine if a value is present on the request and is not an empty string
    if ($this->request->filled('rxcp_prod1_txtsearch')) {

        $rxcp_prod1_txtsearch = $this->request->Input("rxcp_prod1_txtsearch");
        $mytext='%'.$rxcp_prod1_txtsearch.'%';                                       
        $orwhere=array(['rxcp_prod1_product','like',$mytext],['rxcp_prod1_code','like',$mytext]); 
                   
    } 

    $backarray['products']= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    //categories -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['rxcp_cate1_category','asc'];
    $backarray['categories']= $this->rxcp_cate1qy->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  


    return $backarray;     
}


//----------------------------------------------------------
// SEARCH LIST PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearchLink_RXCP_Prod1_BS($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{  
    $backarray=null;

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['rxcp_prod1_id','desc']; $paginate=20;


    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){
      
            // get products by category id
            $where=array(['rxcp_prod1_cate1_id','=',$rxcp_cate1_id],['rxcp_cate1_token','=',$rxcp_cate1_token]);  
            $backarray['products']= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            //categories -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $orderby=['rxcp_cate1_category','asc'];
            $backarray['categories']= $this->rxcp_cate1qy->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        }
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

public function getOrder_RXCP_Prod1_BS()
{  

    // products
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['rxcp_prod1_enable','=','1']);  $orderby=['rxcp_prod1_order','asc'];
    $products= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $products;     
}


//----------------------------------------------------------
// INSERT FORM PRODUCTS PROD1 WHITH CATEGORIES
// POST METHOD
// @param : form params
// @return: $rxcp_prod1_id
// @return: null 
//----------------------------------------------------------

public function insert_RXCP_Prod1_BS()
{

    // products
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['rxcp_cate1_enable','=','1']);  $orderby=['rxcp_cate1_category','asc'];
    $categories= $this->rxcp_cate1qy->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $categories;   
}    

//----------------------------------------------------------
// INSERT PRO PRODUCTS PROD1
// POST METHOD
// @param : form params
// @return: $rxcp_prod1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_RXCP_Prod1_BS()
{

    //two images for upload
    $onearray['rxcp_prod1_image1'] = null;
    $onearray['rxcp_prod1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_RXCP_Prod1_BS($this->request);

    $rxcp_prod1_cate1_id  = $this->request->Input("rxcp_prod1_cate1_id");
    $rxcp_prod1_product   = $this->request->Input("rxcp_prod1_product");
    $rxcp_prod1_code      = $this->request->Input("rxcp_prod1_code");
    $rxcp_prod1_title1    = $this->request->Input("rxcp_prod1_title1");
    $rxcp_prod1_title2    = $this->request->Input("rxcp_prod1_title2");
    $rxcp_prod1_title3    = $this->request->Input("rxcp_prod1_title3");
    $rxcp_prod1_price1    = $this->request->Input("rxcp_prod1_price1");
    $rxcp_prod1_enable    = $this->request->Input("rxcp_prod1_enable");    
    $rxcp_prod1_photo     = $this->request->file('rxcp_prod1_photo'); //files array

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    if ($this->request->has('rxcp_prod1_photo')) {

        $onearray= $this->uploadut->UploadArrayImageUT($onearray,$rxcp_prod1_photo,'rxcp_prod1_image'); 
    
    }

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $rxcp_prod1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array product
    //---------------------------------------------------------- 

    $onearray['rxcp_prod1_cate1_id'] = $rxcp_prod1_cate1_id;
    $onearray['rxcp_prod1_product']  = $rxcp_prod1_product;
    $onearray['rxcp_prod1_code']     = $rxcp_prod1_code;
    $onearray['rxcp_prod1_title1']   = $rxcp_prod1_title1;
    $onearray['rxcp_prod1_title2']   = $rxcp_prod1_title2;
    $onearray['rxcp_prod1_title3']   = $rxcp_prod1_title3;
    $onearray['rxcp_prod1_price1']   = $rxcp_prod1_price1;
    $onearray['rxcp_prod1_enable']   = $rxcp_prod1_enable; 
    $onearray['rxcp_prod1_token']    = $rxcp_prod1_token; 

    $rxcp_prod1_id=$this->insert_RXCP_Prod1_QY($onearray);

    return $rxcp_prod1_id;   

}

//----------------------------------------------------------
// UPDATE FORM PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_RXCP_Prod1_BS($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{   
    $products= null; $backarray=null;

    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            //categories -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_cate1_enable','=','1']);  $orderby=['rxcp_cate1_category','asc'];
            $backarray['categories']= $this->rxcp_cate1qy->get_RXCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            //products ---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_prod1_id','=',$rxcp_prod1_id],['rxcp_prod1_token','=',$rxcp_prod1_token]);
            $backarray['products']= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $backarray;  
}

//----------------------------------------------------------
// UPDATE DATA PRO PRODUCTS PROD1
// POST METHOD
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_RXCP_Prod1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_RXCP_Prod1_BS($this->request);

    $rxcp_prod1_id          = $this->request->Input("rxcp_prod1_id");
    $rxcp_prod1_token       = $this->request->Input("rxcp_prod1_token");
    $rxcp_prod1_cate1_id    = $this->request->Input("rxcp_prod1_cate1_id");
    $rxcp_prod1_product     = $this->request->Input("rxcp_prod1_product");
    $rxcp_prod1_code        = $this->request->Input("rxcp_prod1_code");
    $rxcp_prod1_title1      = $this->request->Input("rxcp_prod1_title1");
    $rxcp_prod1_title2      = $this->request->Input("rxcp_prod1_title2");
    $rxcp_prod1_title3      = $this->request->Input("rxcp_prod1_title3");
    $rxcp_prod1_price1      = $this->request->Input("rxcp_prod1_price1");
    $rxcp_prod1_enable      = $this->request->Input("rxcp_prod1_enable");    
    $rxcp_prod1_photo       = $this->request->file('rxcp_prod1_photo'); //files array

    // all the product info
    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            //----------------------------------------------------------
            // product previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_prod1_id','=',$rxcp_prod1_id],['rxcp_prod1_token','=',$rxcp_prod1_token]);
            $products= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($products[0]->rxcp_prod1_id)){ 

                //asign product images to onearray
                $onearray['rxcp_prod1_image1'] = $products[0]->rxcp_prod1_image1;
                $onearray['rxcp_prod1_image2'] = $products[0]->rxcp_prod1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images rxcp_prod1_photo == null,  to images $onearray
                //----------------------------------------------------------

                if ($this->request->has('rxcp_prod1_photo')) {

                    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$rxcp_prod1_photo,'rxcp_prod1_image');
                
                }

                //----------------------------------------------------------
                // update array product with text info
                //---------------------------------------------------------- 
               
                $onearray['rxcp_prod1_cate1_id']    = $rxcp_prod1_cate1_id;
                $onearray['rxcp_prod1_product']     = $rxcp_prod1_product;
                $onearray['rxcp_prod1_code']        = $rxcp_prod1_code;
                $onearray['rxcp_prod1_title1']      = $rxcp_prod1_title1;
                $onearray['rxcp_prod1_title2']      = $rxcp_prod1_title2;
                $onearray['rxcp_prod1_title3']      = $rxcp_prod1_title3;
                $onearray['rxcp_prod1_price1']      = $rxcp_prod1_price1;
                $onearray['rxcp_prod1_enable']      = $rxcp_prod1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_RXCP_Prod1_QY($onearray,$rxcp_prod1_id,$rxcp_prod1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_RXCP_Prod1_BS($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{

    $deletepro = null;
    
    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            $deletepro=$this->delete_RXCP_Prod1_QY($rxcp_prod1_id,$rxcp_prod1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_RXCP_Prod1_BS($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{   
    $clonepro= null; 

    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_prod1_id','=',$rxcp_prod1_id],['rxcp_prod1_token','=',$rxcp_prod1_token]);
            $products= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($products[0]->rxcp_prod1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $rxcp_prod1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new product
                //---------------------------------------------------------- 

                $onearray = [
                    'rxcp_prod1_cate1_id'   => $products[0]->rxcp_prod1_cate1_id,
                    'rxcp_prod1_product'    => $products[0]->rxcp_prod1_product,
                    'rxcp_prod1_code'       => $products[0]->rxcp_prod1_code,
                    'rxcp_prod1_title1'     => $products[0]->rxcp_prod1_title1,
                    'rxcp_prod1_title2'     => $products[0]->rxcp_prod1_title2,
                    'rxcp_prod1_title3'     => $products[0]->rxcp_prod1_title3,
                    'rxcp_prod1_price1'     => $products[0]->rxcp_prod1_price1,
                    'rxcp_prod1_enable'     => 0,
                    'rxcp_prod1_image1'     => $products[0]->rxcp_prod1_image1,
                    'rxcp_prod1_image2'     => $products[0]->rxcp_prod1_image2,
                    'rxcp_prod1_token'      => $rxcp_prod1_token,
                ];

                //rxcp_prod1_id
                $clonepro=$this->insert_RXCP_Prod1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO PRODUCTS PROD1
// POST METHOD
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_RXCP_Prod1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_RXCP_Prod1_BS($this->request);

    $backarray['rxcp_prod1_id']     = $this->request->Input("rxcp_prod1_id"); // array to routing
    $backarray['rxcp_prod1_token']  = $this->request->Input("rxcp_prod1_token"); // array to routing
    $rxcp_prod1_photo               = $this->request->file('rxcp_prod1_photo'); //files array

    // all the product info
    if(isset($backarray['rxcp_prod1_id']) and is_numeric($backarray['rxcp_prod1_id'])){

        if(isset($backarray['rxcp_prod1_token']) and is_string($backarray['rxcp_prod1_token'])){

            //----------------------------------------------------------
            // product previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['rxcp_prod1_id','=',$backarray['rxcp_prod1_id']],['rxcp_prod1_token','=',$backarray['rxcp_prod1_token']]);
            $products= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($products[0]->rxcp_prod1_id)){ 

                //asign product images to onearray
                $onearray['rxcp_prod1_image1'] = $products[0]->rxcp_prod1_image1;
                $onearray['rxcp_prod1_image2'] = $products[0]->rxcp_prod1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images rxcp_prod1_photo == null,  to images $onearray
                //----------------------------------------------------------

                if ($this->request->has('rxcp_prod1_photo')) {

                    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$rxcp_prod1_photo,'rxcp_prod1_image');  

                }
            
                //---------------------------------------------------------
                //1=ok or 0=error
                $updateimagespro=$this->update_RXCP_Prod1_QY($onearray,$backarray['rxcp_prod1_id'],$backarray['rxcp_prod1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}


//----------------------------------------------------------
// DELETE IMAGES PRO PRODUCTS PROD1
// GET METHOD
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_RXCP_Prod1_BS($rxcp_prod1_id=null,$rxcp_prod1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['rxcp_prod1_image1'] = null; }
                    if($image_number=='2'){ $onearray['rxcp_prod1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_RXCP_Prod1_QY($onearray,$rxcp_prod1_id,$rxcp_prod1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO PRODUCTS PROD1
// POST METHOD - ANGULAR JS
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_RXCP_Prod1_BS()
{

    $backarray['rxcp_prod1_id']  = null;
    $backarray['rxcp_prod1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $rxcp_prod1_id     = $this->request->Input("rxcp_prod1_id");
    $rxcp_prod1_token  = $this->request->Input("rxcp_prod1_token");
    $button            = $this->request->Input("button");

    // all the product info
    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // product confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['rxcp_prod1_id','=',$rxcp_prod1_id],['rxcp_prod1_token','=',$rxcp_prod1_token]);
                $products= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($products[0]->rxcp_prod1_id)){
             
                    //----------------------------------------------------------
                    // update array product with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['rxcp_prod1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['rxcp_prod1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_RXCP_Prod1_QY($onearray,$rxcp_prod1_id,$rxcp_prod1_token);

                    if($updatepro=='1'){

                        $backarray['rxcp_prod1_id']    = $rxcp_prod1_id;
                        $backarray['rxcp_prod1_token'] = $rxcp_prod1_token;
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
// @param : $rxcp_prod1_id
// @param : $rxcp_prod1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_RXCP_Prod1_BS()
{

    $backarray['rxcp_prod1_id']  = null;
    $backarray['rxcp_prod1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $rxcp_prod1_id     = $this->request->Input("rxcp_prod1_id");
    $rxcp_prod1_token  = $this->request->Input("rxcp_prod1_token");
    $order             = $this->request->Input("order");

    // all the product info
    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // product confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['rxcp_prod1_id','=',$rxcp_prod1_id],['rxcp_prod1_token','=',$rxcp_prod1_token]);
                $products= $this->get_RXCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($products[0]->rxcp_prod1_id)){
             
                    //----------------------------------------------------------
                    // update array product with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['rxcp_prod1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_RXCP_Prod1_QY($onearray,$rxcp_prod1_id,$rxcp_prod1_token);

                    if($updatepro=='1'){

                        $backarray['rxcp_prod1_id']     = $rxcp_prod1_id;
                        $backarray['rxcp_prod1_token']  = $rxcp_prod1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}