<?php

declare(strict_types=1);

namespace App\AppBusiness\CCC_Cont1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\AppQuerys\CCC_Cont1_Data_QY;
use Stringable;

//----------------------------------------------------------
// PRODUCTS PROD1 BUSINESS
//----------------------------------------------------------
// Class   : CCC_Cont1_Main_BS
// Used by : CCC_Cont1Controller
//----------------------------------------------------------
// get_CCC_Cont1_BS
//----------------------------------------------------------

class CCC_Cont1_Main_BS extends CCC_Cont1_Data_QY
{

public function __construct(Request $request)
{
   $this->request=$request; 
}

//----------------------------------------------------------
// LIST CONTACTS CONT1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function get_CCC_Cont1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;
    $orderby=['ccc_cont1_id','desc']; $paginate=20;
    $contacts= $this->get_CCC_Cont1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $contacts;     
}



//----------------------------------------------------------
// SEARCH LIST PRODUCTS CATE1-PROD1
// GET METHOD
// @param : 
// @return: object(Illuminate\Support\Collection) 
// @return: object(Illuminate\Support\Collection)["items":protected]=>array(0)
//----------------------------------------------------------

public function getSearch_CCC_Prod1_BS()
{  

    $where=null; $orwhere=null; $orderby=null; $paginate=null; $limit=null;    
    $orderby=['ccc_cont1_id','desc']; $paginate=20;

    //-----------------------
    //determine if a value is present on the request and is not an empty string
    if ($this->request->filled('ccc_cont1_txtsearch')) {

        $ccc_cont1_txtsearch = $this->request->Input("ccc_cont1_txtsearch");
        $mytext='%'.$ccc_cont1_txtsearch.'%';                                       
        $orwhere=array(['ccc_cont1_surname','like',$mytext],['ccc_cont1_company','like',$mytext],['ccc_cont1_text1','like',$mytext]);                    
    } 

    $contacts= $this->get_CCC_Cont1_QY($where,$orwhere,$orderby,$paginate,$limit); 

    return $contacts;     
}


//----------------------------------------------------------
// DELETE PRO CONTACTS CONT1
// GET METHOD
// @param : $ccc_cont1_id
// @param : $ccc_cont1_token
// @return ok: 1 bolean 
// @return error: 0 false 
//----------------------------------------------------------

public function deletePro_CCC_Cont1_BS($ccc_cont1_id=null,$ccc_cont1_token=null)
{

    $deletepro = null;
    
    if(isset($ccc_cont1_id) and is_numeric($ccc_cont1_id)){

        if(isset($ccc_cont1_token) and is_string($ccc_cont1_token)){

            $check_exist= $this->checkRecordExist_CCC_Cont1_QY($ccc_cont1_id,$ccc_cont1_token); 

            if($check_exist==true) { 
                
                $deletepro=$this->delete_CCC_Cont1_QY($ccc_cont1_id,$ccc_cont1_token);
            }
        }
    }

    return $deletepro; 
}



//----------------------------------------------------------
}