<?php
declare(strict_types=1);

namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\bbp_prod1;

//----------------------------------------------------------
// BBP_Prod1_Data_QY TM - REPOSITORY PATTERN
//----------------------------------------------------------
// Model   : BBP_Prod1_Data_QY DB query builder
// Used by : BBP_Prod1_Main_BS
//----------------------------------------------------------
// get_BBP_Prod1_QY
// insert_BBP_Prod1_QY
// update_BBP_Prod1_QY
// delete_BBP_Prod1_QY


class BBP_Prod1_Data_QY {

public function __construct()
{

}

//----------------------------------------------------------
// SELECT PRODUCTSS
// @param  : array $where
// @param  : array $orwhere
// @param  : array $orderby
// @param  : int $paginate
// @param  : int $limit
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------



public function get_BBP_Prod1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('bbp_prod1')->select('bbp_prod1_id','bbp_prod1_product','bbp_prod1_code','bbp_prod1_price1','bbp_prod1_title1','bbp_prod1_title2','bbp_prod1_title3','bbp_prod1_title4','bbp_prod1_title5','bbp_prod1_title6','bbp_prod1_text1','bbp_prod1_text2','bbp_prod1_text3','bbp_prod1_image1','bbp_prod1_image2','bbp_prod1_image3','bbp_prod1_image4','bbp_prod1_image5','bbp_prod1_image6','bbp_prod1_image7','bbp_prod1_image8','bbp_prod1_image9','bbp_prod1_image10','bbp_prod1_doc1','bbp_prod1_doc2','bbp_prod1_doc3','bbp_prod1_video1','bbp_prod1_video2','bbp_prod1_order','bbp_prod1_enable','bbp_prod1_created_at','bbp_prod1_updated_at','bbp_prod1_token')

        //------------------------------------------------
        // WHERE
        ->when($where, function ($query, $where) {  

            foreach ($where as $key => $condition) {               

                $query=$query->where($condition[0], $condition[1],$condition[2]);

            }  

            return $query;

        })
        //------------------------------------------------
        //OR
        ->when($orwhere, function ($query, $orwhere) {  

             //AND
             $query=$query->where(function ($query) use ($orwhere) {

                        foreach ($orwhere as $key => $condition) {

                            if($key==0){

                                $query=$query->where($condition[0], $condition[1],$condition[2]);

                            } else {

                                $query=$query->orwhere($condition[0], $condition[1],$condition[2]);
                            }
                        }  
             });                         

            return $query;
        })

        //------------------------------------------------
        //LIMIT
        ->when($limit, function ($query, $limit) {              

            if(isset($limit)){                     

                $query=$query->limit($limit); 

                return $query;                 

            } 
        })

        //------------------------------------------------
        //ORDERBY
        ->when($orderby, function ($query, $orderby) { 

            if(isset($orderby[0],$orderby[1])){                       

                $query=$query->orderBy($orderby[0], $orderby[1]);             

                return $query;

            }

        })
        //------------------------------------------------
        //PAGINATION
        ->when($paginate, function ($query, $paginate) {
                    
                $query=$query->paginate($paginate)->withQueryString();
                    
                return $query;
                
            }, function ($query) {
                   
                $query=$query->get();

                return $query;                
        }); 

    return $records;
}


//----------------------------------------------------------
// INSERT PRODUCTS
// @param : array $onearray
// @return : int $bbp_prod1_id
// @return: boolean false
//----------------------------------------------------------

public function insert_BBP_Prod1_QY($onearray=null)
{
    $bbp_prod1_id=null;

    if(isset($onearray) and is_iterable($onearray)){

        $bbp_prod1_id = DB::table('bbp_prod1')->insertGetId($onearray,'bbp_prod1_id'); 
    }

    return $bbp_prod1_id;
}

//----------------------------------------------------------
// UPDATE PRODUCTS
// @param : int $bbp_prod1_id
// @param : int $bbp_prod1_token
// @return: boolean
//----------------------------------------------------------

public function update_BBP_Prod1_QY($onearray=null,$bbp_prod1_id=null,$bbp_prod1_token=null)
{
   $update=null;

    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){

        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){ 

            if(isset($onearray) and is_iterable($onearray)){

                $update = DB::table('bbp_prod1')
                            ->where('bbp_prod1_id',$bbp_prod1_id)
                            ->where('bbp_prod1_token',$bbp_prod1_token)
                            ->update($onearray);                               
            }
        } 
    } 

    return $update;  
}

//----------------------------------------------------------
// DELETE PRODUCTS BY ID AND TOKEN
// @param : int $bbp_prod1_id
// @param : int $bbp_prod1_token
// @return: int $delete
//----------------------------------------------------------

public function delete_BBP_Prod1_QY($bbp_prod1_id=null,$bbp_prod1_token=null)
{   

    $delete = false;

    if(isset($bbp_prod1_id) and is_numeric($bbp_prod1_id)){
        if(isset($bbp_prod1_token) and is_string($bbp_prod1_token)){

            $delete = DB::table('bbp_prod1')
                        ->where('bbp_prod1_id',$bbp_prod1_id)
                        ->where('bbp_prod1_token',$bbp_prod1_token)
                        ->delete();
        }       
    } 

    return $delete;
}

//------------------------------------------------
}  