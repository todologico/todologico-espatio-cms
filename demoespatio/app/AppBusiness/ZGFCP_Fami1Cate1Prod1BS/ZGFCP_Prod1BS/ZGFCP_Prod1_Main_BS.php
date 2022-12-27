<?php

declare(strict_types=1);

namespace App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Prod1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\ZGFCP_Fami1_Data_QY;
use App\AppQuerys\ZGFCP_Cate1_Data_QY;
use App\AppQuerys\ZGFCP_Prod1_Data_QY;
use App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Prod1BS\ZGFCP_Prod1_Validation_BS;

use App\AppUtils\UploadUT;
use App\AppUtils\TokenUT;

//----------------------------------------------------------
// PRODUCTS PROD1 BUSINESS
//----------------------------------------------------------
// Class   : ZGFCP_Prod1_Main_BS
// Used by : ZGFCP_Prod1Controller
//----------------------------------------------------------
// get_ZGFCP_Prod1_BS
// getSearch_ZGFCP_Prod1_BS
// getSearchLink_ZGFCP_Prod1_BS
// getOrder_ZGFCP_Prod1_BS
// insert_ZGFCP_Prod1_BS
// insertPro_ZGFCP_Prod1_BS
// update_ZGFCP_Prod1_BS
// updatePro_ZGFCP_Prod1_BS
// deletePro_ZGFCP_Prod1_BS
// clonePro_ZGFCP_Prod1_BS
// updateImagesPro_ZGFCP_Prod1_BS
// deleteImagesPro_ZGFCP_Prod1_BS
// publishPro_ZGFCP_Prod1_BS
// orderPro_ZGFCP_Prod1_BS
//----------------------------------------------------------

class ZGFCP_Prod1_Main_BS extends ZGFCP_Prod1_Data_QY
{

//----------------------------------------------------------
// CONSTRUCTOR
//----------------------------------------------------------

public function __construct(Request $request, UploadUT $uploadut, TokenUT $tokenut, ZGFCP_Prod1_Validation_BS $validatebs,ZGFCP_Cate1_Data_QY $zgfcp_cate1qy, ZGFCP_Fami1_Data_QY $zgfcp_fami1qy)
{
   $this->request=$request; 
   $this->uploadut=$uploadut; 
   $this->tokenut=$tokenut; 
   $this->validatebs=$validatebs; 
   $this->zgfcp_cate1qy=$zgfcp_cate1qy; 
   $this->zgfcp_fami1qy=$zgfcp_fami1qy; 
}

//----------------------------------------------------------
// LIST PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_ZGFCP_Prod1_BS()
{  
    //families -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_fami1_family','asc'];    
    $backarray['families']= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  
    
    //categories -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_cate1_category','asc'];
    $backarray['categories']= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  
    
    //products------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_prod1_id','desc']; $paginate=100;
    $backarray['products']= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 
    
    return $backarray;     
}

//----------------------------------------------------------
// SEARCH LIST PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearch_ZGFCP_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['zgfcp_prod1_id','desc']; $paginate=20;

    $zgfcp_fami1_id = $this->request->Input("zgfcp_fami1_id");
    $zgfcp_cate1_id = $this->request->Input("zgfcp_cate1_id");

    //-----------------------
    //family search
    if(isset($zgfcp_fami1_id) and $zgfcp_fami1_id<> '0'){        

        $where[]=['zgfcp_prod1_fami1_id','=',$zgfcp_fami1_id];
     } 

    //-----------------------
    //category search
    if(isset($zgfcp_cate1_id) and $zgfcp_cate1_id <> '0'){        

      $where[]=['zgfcp_prod1_cate1_id','=',$zgfcp_cate1_id];
    } 

    //-----------------------
    //determine if a value is present on the request and is not an empty string
    if ($this->request->filled('zgfcp_prod1_txtsearch')) {

        $zgfcp_prod1_txtsearch = $this->request->Input("zgfcp_prod1_txtsearch");
        $mytext='%'.$zgfcp_prod1_txtsearch.'%';                                       
        $orwhere=array(['zgfcp_prod1_product','like',$mytext],['zgfcp_prod1_code','like',$mytext]); 
                   
    } 

    $backarray['products']= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    //families -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_fami1_family','asc'];        
    $backarray['families']= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  
    
    //categories -------------------------------------------------------------
    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['zgfcp_cate1_category','asc'];
    $backarray['categories']= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

    return $backarray;     
}

//----------------------------------------------------------
// SEARCH LIST PRODUCTS FAMI1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearchLinkxFami1_ZGFCP_Prod1_BS($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{  
    $backarray=null;

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['zgfcp_prod1_id','desc']; $paginate=20;

    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token))
        {
      
            // get products by category id
            $where=array(['zgfcp_prod1_fami1_id','=',$zgfcp_fami1_id],['zgfcp_fami1_token','=',$zgfcp_fami1_token]); 
            $backarray['products']= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            //families -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $orderby=['zgfcp_fami1_family','asc'];        
            $backarray['families']= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  
    
            //categories -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_enable','=','1']);  $orderby=['zgfcp_cate1_category','asc'];
            $backarray['categories']= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

        }
    }

    return $backarray;     
}


//----------------------------------------------------------
// SEARCH LINK CATE1 PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearchLinkxCate1_ZGFCP_Prod1_BS($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{  
    $backarray=null;

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['zgfcp_prod1_id','desc']; $paginate=20;

    if(isset($zgfcp_cate1_id) and is_numeric($zgfcp_cate1_id)){

        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token))
        {
      
            // get products by category id
            $where=array(['zgfcp_prod1_cate1_id','=',$zgfcp_cate1_id],['zgfcp_cate1_token','=',$zgfcp_cate1_token]); 
            $backarray['products']= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            //families -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $orderby=['zgfcp_fami1_family','asc'];        
            $backarray['families']= $this->zgfcp_fami1qy->get_ZGFCP_Fami1_QY($where,$orwhere,$orderby,$paginate,$limit);  
    
            //categories -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_enable','=','1']);  $orderby=['zgfcp_cate1_category','asc'];
            $backarray['categories']= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

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

public function getOrder_ZGFCP_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_prod1_enable','=','1']);  $orderby=['zgfcp_prod1_order','asc'];
    $products= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $products;     
}


//----------------------------------------------------------
// INSERT FORM PRODUCTS PROD1 WHITH CATEGORIES
// POST METHOD
// @param : form params
// @return: $zgfcp_prod1_id
// @return: null 
//----------------------------------------------------------

public function insert_ZGFCP_Prod1_BS()
{

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_cate1_enable','=','1']);  $orderby=['zgfcp_cate1_category','asc'];
    $categories= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $categories;   
}    

//----------------------------------------------------------
// INSERT PRO PRODUCTS PROD1
// POST METHOD
// @param : form params
// @return: $zgfcp_prod1_id
// @return: null 
//----------------------------------------------------------

public function insertPro_ZGFCP_Prod1_BS()
{

    //two images for upload
    $onearray['zgfcp_prod1_image1'] = null;
    $onearray['zgfcp_prod1_image2'] = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_ZGFCP_Prod1_BS($this->request);

    $zgfcp_prod1_cate1_id  = $this->request->Input("zgfcp_prod1_cate1_id");
    $zgfcp_prod1_product   = $this->request->Input("zgfcp_prod1_product");
    $zgfcp_prod1_code      = $this->request->Input("zgfcp_prod1_code");
    $zgfcp_prod1_title1    = $this->request->Input("zgfcp_prod1_title1");
    $zgfcp_prod1_title2    = $this->request->Input("zgfcp_prod1_title2");
    $zgfcp_prod1_title3    = $this->request->Input("zgfcp_prod1_title3");
    $zgfcp_prod1_price1    = $this->request->Input("zgfcp_prod1_price1");
    $zgfcp_prod1_enable    = $this->request->Input("zgfcp_prod1_enable");    
    $zgfcp_prod1_photo     = $this->request->file('zgfcp_prod1_photo'); //files array

    //--------------------------------------------------
    //search family id by zgfcp_cate1_id
    //--------------------------------------------------

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_cate1_id','=',$zgfcp_prod1_cate1_id]);
    $categories= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    $zgfcp_cate1_fami1_id = $categories[0]->zgfcp_cate1_fami1_id;

    //----------------------------------------------------------
    // to upload images
    //----------------------------------------------------------

    $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_prod1_photo,'zgfcp_prod1_image');

    //----------------------------------------------------------
    // token
    //----------------------------------------------------------
    
    $zgfcp_prod1_token=$this->tokenut->generatorTokenUT(200); 

    //----------------------------------------------------------
    // insert array product
    //---------------------------------------------------------- 

    $onearray['zgfcp_prod1_fami1_id'] = $zgfcp_cate1_fami1_id;
    $onearray['zgfcp_prod1_cate1_id'] = $zgfcp_prod1_cate1_id;
    $onearray['zgfcp_prod1_product']  = $zgfcp_prod1_product;
    $onearray['zgfcp_prod1_code']     = $zgfcp_prod1_code;
    $onearray['zgfcp_prod1_title1']   = $zgfcp_prod1_title1;
    $onearray['zgfcp_prod1_title2']   = $zgfcp_prod1_title2;
    $onearray['zgfcp_prod1_title3']   = $zgfcp_prod1_title3;
    $onearray['zgfcp_prod1_price1']   = $zgfcp_prod1_price1;
    $onearray['zgfcp_prod1_enable']   = $zgfcp_prod1_enable; 
    $onearray['zgfcp_prod1_token']    = $zgfcp_prod1_token; 

    $zgfcp_prod1_id=$this->insert_ZGFCP_Prod1_QY($onearray);

    return $zgfcp_prod1_id;   

}

//----------------------------------------------------------
// UPDATE FORM PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function update_ZGFCP_Prod1_BS($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{   
    $products= null; $backarray=null;

    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            //categories -------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_cate1_enable','=','1']);  $orderby=['zgfcp_cate1_category','asc'];
            $backarray['categories']= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            //products ---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_prod1_id','=',$zgfcp_prod1_id],['zgfcp_prod1_token','=',$zgfcp_prod1_token]);
            $backarray['products']= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

        } 
    } 

    return $backarray;  
}

//----------------------------------------------------------
// UPDATE DATA PRO PRODUCTS PROD1
// POST METHOD
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updatePro_ZGFCP_Prod1_BS()
{

    $updatepro=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateForm_ZGFCP_Prod1_BS($this->request);

    $zgfcp_prod1_id          = $this->request->Input("zgfcp_prod1_id");
    $zgfcp_prod1_token       = $this->request->Input("zgfcp_prod1_token");
    $zgfcp_prod1_cate1_id    = $this->request->Input("zgfcp_prod1_cate1_id");
    $zgfcp_prod1_product     = $this->request->Input("zgfcp_prod1_product");
    $zgfcp_prod1_code        = $this->request->Input("zgfcp_prod1_code");
    $zgfcp_prod1_title1      = $this->request->Input("zgfcp_prod1_title1");
    $zgfcp_prod1_title2      = $this->request->Input("zgfcp_prod1_title2");
    $zgfcp_prod1_title3      = $this->request->Input("zgfcp_prod1_title3");
    $zgfcp_prod1_price1      = $this->request->Input("zgfcp_prod1_price1");
    $zgfcp_prod1_enable      = $this->request->Input("zgfcp_prod1_enable");    
    $zgfcp_prod1_photo       = $this->request->file('zgfcp_prod1_photo'); //files array


    //--------------------------------------------------
    //search family id by zgfcp_cate1_id
    //--------------------------------------------------

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $where=array(['zgfcp_cate1_id','=',$zgfcp_prod1_cate1_id]);
    $categories= $this->zgfcp_cate1qy->get_ZGFCP_Cate1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    $zgfcp_cate1_fami1_id = $categories[0]->zgfcp_cate1_fami1_id;



    // all the product info
    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            //----------------------------------------------------------
            // product previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_prod1_id','=',$zgfcp_prod1_id],['zgfcp_prod1_token','=',$zgfcp_prod1_token]);
            $products= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

            if(isset($products[0]->zgfcp_prod1_id)){ 

                //asign product images to onearray
                $onearray['zgfcp_prod1_image1'] = $products[0]->zgfcp_prod1_image1;
                $onearray['zgfcp_prod1_image2'] = $products[0]->zgfcp_prod1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images zgfcp_prod1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_prod1_photo,'zgfcp_prod1_image');

                //----------------------------------------------------------
                // update array product with text info
                //---------------------------------------------------------- 
               
                $onearray['zgfcp_prod1_fami1_id']    = $zgfcp_cate1_fami1_id;
                $onearray['zgfcp_prod1_cate1_id']    = $zgfcp_prod1_cate1_id;
                $onearray['zgfcp_prod1_product']     = $zgfcp_prod1_product;
                $onearray['zgfcp_prod1_code']        = $zgfcp_prod1_code;
                $onearray['zgfcp_prod1_title1']      = $zgfcp_prod1_title1;
                $onearray['zgfcp_prod1_title2']      = $zgfcp_prod1_title2;
                $onearray['zgfcp_prod1_title3']      = $zgfcp_prod1_title3;
                $onearray['zgfcp_prod1_price1']      = $zgfcp_prod1_price1;
                $onearray['zgfcp_prod1_enable']      = $zgfcp_prod1_enable;   

                //1=ok or 0=error
                $updatepro=$this->update_ZGFCP_Prod1_QY($onearray,$zgfcp_prod1_id,$zgfcp_prod1_token);              

            }

        } 
    } 
    
    return $updatepro; 
}

//----------------------------------------------------------
// DELETE PRO PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_ZGFCP_Prod1_BS($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{

    $deletepro = null;
    
    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            $deletepro=$this->delete_ZGFCP_Prod1_QY($zgfcp_prod1_id,$zgfcp_prod1_token); 
        }
    }

    return $deletepro; 
}

//----------------------------------------------------------
// CLONE FORM PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function clonePro_ZGFCP_Prod1_BS($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{   
    $clonepro= null; 

    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            //---------------------------------------------------------------
            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_prod1_id','=',$zgfcp_prod1_id],['zgfcp_prod1_token','=',$zgfcp_prod1_token]);
            $products= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit); 

             if(isset($products[0]->zgfcp_prod1_id)){ 

                //----------------------------------------------------------
                // token
                //----------------------------------------------------------

                $zgfcp_prod1_token=$this->tokenut->generatorTokenUT(200); 

                //----------------------------------------------------------
                // insert new product
                //---------------------------------------------------------- 

                $onearray = [
                    'zgfcp_prod1_fami1_id'   => $products[0]->zgfcp_prod1_fami1_id,
                    'zgfcp_prod1_cate1_id'   => $products[0]->zgfcp_prod1_cate1_id,
                    'zgfcp_prod1_product'    => $products[0]->zgfcp_prod1_product,
                    'zgfcp_prod1_code'       => $products[0]->zgfcp_prod1_code,
                    'zgfcp_prod1_title1'     => $products[0]->zgfcp_prod1_title1,
                    'zgfcp_prod1_title2'     => $products[0]->zgfcp_prod1_title2,
                    'zgfcp_prod1_title3'     => $products[0]->zgfcp_prod1_title3,
                    'zgfcp_prod1_price1'     => $products[0]->zgfcp_prod1_price1,
                    'zgfcp_prod1_enable'     => 0,
                    'zgfcp_prod1_image1'     => $products[0]->zgfcp_prod1_image1,
                    'zgfcp_prod1_image2'     => $products[0]->zgfcp_prod1_image2,
                    'zgfcp_prod1_token'      => $zgfcp_prod1_token,
                ];

                //zgfcp_prod1_id
                $clonepro=$this->insert_ZGFCP_Prod1_QY($onearray);

            }

            //---------------------------------------------------------------
        } 
    } 

    return $clonepro;  
}

//----------------------------------------------------------
// UPDATE IMAGES PRO PRODUCTS PROD1
// POST METHOD
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @param : form params
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function updateImagesPro_ZGFCP_Prod1_BS()
{
    
    // array to routing
    $backarray=null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------
    $validate= $this->validatebs->validateImagesForm_ZGFCP_Prod1_BS($this->request);

    $backarray['zgfcp_prod1_id']     = $this->request->Input("zgfcp_prod1_id"); // array to routing
    $backarray['zgfcp_prod1_token']  = $this->request->Input("zgfcp_prod1_token"); // array to routing
    $zgfcp_prod1_photo               = $this->request->file('zgfcp_prod1_photo'); //files array

    // all the product info
    if(isset($backarray['zgfcp_prod1_id']) and is_numeric($backarray['zgfcp_prod1_id'])){

        if(isset($backarray['zgfcp_prod1_token']) and is_string($backarray['zgfcp_prod1_token'])){

            //----------------------------------------------------------
            // product previous image data to $onearray
            //----------------------------------------------------------

            $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
            $where=array(['zgfcp_prod1_id','=',$backarray['zgfcp_prod1_id']],['zgfcp_prod1_token','=',$backarray['zgfcp_prod1_token']]);
            $products= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

            if(isset($products[0]->zgfcp_prod1_id)){ 

                //asign product images to onearray
                $onearray['zgfcp_prod1_image1'] = $products[0]->zgfcp_prod1_image1;
                $onearray['zgfcp_prod1_image2'] = $products[0]->zgfcp_prod1_image2;

                //----------------------------------------------------------
                // to upload images, if there are no images zgfcp_prod1_photo == null,  to images $onearray
                //----------------------------------------------------------

                $onearray= $this->uploadut->UploadArrayImageUT($onearray,$zgfcp_prod1_photo,'zgfcp_prod1_image');              

                //1=ok or 0=error
                $updateimagespro=$this->update_ZGFCP_Prod1_QY($onearray,$backarray['zgfcp_prod1_id'],$backarray['zgfcp_prod1_token']);

                $backarray['updateimagespro']= $updateimagespro;
            }
        } 
    } 
    
    return $backarray; 
}


//----------------------------------------------------------
// DELETE IMAGES PRO PRODUCTS PROD1
// GET METHOD
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deleteImagesPro_ZGFCP_Prod1_BS($zgfcp_prod1_id=null,$zgfcp_prod1_token=null,$image_number=null)
{

    $deleteimagespro = null;
    
    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            if(isset($image_number) and is_numeric($image_number)){

                if($image_number=='1' or $image_number=='2'){

                    if($image_number=='1'){ $onearray['zgfcp_prod1_image1'] = null; }
                    if($image_number=='2'){ $onearray['zgfcp_prod1_image2'] = null; }

                    //1=ok, 0 = error
                    $deleteimagespro=$this->update_ZGFCP_Prod1_QY($onearray,$zgfcp_prod1_id,$zgfcp_prod1_token); 
                }            
            }
        }
    }

    return $deleteimagespro; 
}

//----------------------------------------------------------
// PUBLISH OR HIDDEN PRO PRODUCTS PROD1
// POST METHOD - ANGULAR JS
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function publishPro_ZGFCP_Prod1_BS()
{

    $backarray['zgfcp_prod1_id']  = null;
    $backarray['zgfcp_prod1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $zgfcp_prod1_id     = $this->request->Input("zgfcp_prod1_id");
    $zgfcp_prod1_token  = $this->request->Input("zgfcp_prod1_token");
    $button             = $this->request->Input("button");

    // all the product info
    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            if(isset($button) and is_numeric($button)){

                //----------------------------------------------------------
                // product confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['zgfcp_prod1_id','=',$zgfcp_prod1_id],['zgfcp_prod1_token','=',$zgfcp_prod1_token]);
                $products= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($products[0]->zgfcp_prod1_id)){
             
                    //----------------------------------------------------------
                    // update array product with enable info
                    //----------------------------------------------------------  
                   
                   if($button=='1' or $button=='4'){ $onearray['zgfcp_prod1_enable']= 0; }
                   if($button=='2' or $button=='3'){ $onearray['zgfcp_prod1_enable']= 1; }

                    //1=ok or 0=error
                    $updatepro=$this->update_ZGFCP_Prod1_QY($onearray,$zgfcp_prod1_id,$zgfcp_prod1_token);

                    if($updatepro=='1'){

                        $backarray['zgfcp_prod1_id']    = $zgfcp_prod1_id;
                        $backarray['zgfcp_prod1_token'] = $zgfcp_prod1_token;
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
// @param : $zgfcp_prod1_id
// @param : $zgfcp_prod1_token
// @return ok: 1 true 
// @return error: 0 false 
//----------------------------------------------------------

public function orderPro_ZGFCP_Prod1_BS()
{

    $backarray['zgfcp_prod1_id']  = null;
    $backarray['zgfcp_prod1_token']  = null;

    //----------------------------------------------------------
    // form validation
    //----------------------------------------------------------

    $zgfcp_prod1_id     = $this->request->Input("zgfcp_prod1_id");
    $zgfcp_prod1_token  = $this->request->Input("zgfcp_prod1_token");
    $order              = $this->request->Input("order");

    // all the product info
    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            if(isset($order) and is_numeric($order)){

                //----------------------------------------------------------
                // product confirmation exists
                //----------------------------------------------------------

                $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
                $where=array(['zgfcp_prod1_id','=',$zgfcp_prod1_id],['zgfcp_prod1_token','=',$zgfcp_prod1_token]);
                $products= $this->get_ZGFCP_Prod1_QY($where,$orwhere,$orderby,$paginate,$limit);  

                if(isset($products[0]->zgfcp_prod1_id)){
             
                    //----------------------------------------------------------
                    // update array product with enable info
                    //----------------------------------------------------------  
                   
                    $onearray['zgfcp_prod1_order']= $order;

                    //1=ok or 0=error
                    $updatepro=$this->update_ZGFCP_Prod1_QY($onearray,$zgfcp_prod1_id,$zgfcp_prod1_token);

                    if($updatepro=='1'){

                        $backarray['zgfcp_prod1_id']     = $zgfcp_prod1_id;
                        $backarray['zgfcp_prod1_token']  = $zgfcp_prod1_token;
                    }

                }

            } 
        } 
    } 
    
    return $backarray; 
}

//----------------------------------------------------------
}