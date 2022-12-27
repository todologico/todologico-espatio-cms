<?php
declare(strict_types=1);

namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\rxcp_prod1;

//----------------------------------------------------------
// RXCP_Prod1_QY TM - REPOSITORY PATTERN
//----------------------------------------------------------
// Model   : RXCP_Prod1_Data_QY DB query builder
// Used by : RXCP_Prod1_Main_BS
//----------------------------------------------------------
// get_RXCP_Prod1_QY
// insert_RXCP_Prod1_QY
// update_RXCP_Prod1_QY
// delete_RXCP_Prod1_QY
// countCategory_RXCP_Prod1_QY
//----------------------------------------------------------

class RXCP_Prod1_Data_QY {

public function __construct()
{

}

//----------------------------------------------------------
// SELECT PRODUCTS
// @param  : array $where
// @param  : array $orwhere
// @param  : array $orderby
// @param  : int $paginate
// @param  : int $limit
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------

public function get_RXCP_Prod1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('rxcp_prod1')
    ->join('rxcp_cate1', 'rxcp_prod1.rxcp_prod1_cate1_id', '=', 'rxcp_cate1.rxcp_cate1_id')
    ->select('rxcp_prod1_id','rxcp_prod1_cate1_id','rxcp_prod1_product','rxcp_prod1_code','rxcp_prod1_price1','rxcp_prod1_title1','rxcp_prod1_title2','rxcp_prod1_title3','rxcp_prod1_title4','rxcp_prod1_title5','rxcp_prod1_title6','rxcp_prod1_text1','rxcp_prod1_text2','rxcp_prod1_text3','rxcp_prod1_image1','rxcp_prod1_image2','rxcp_prod1_image3','rxcp_prod1_image4','rxcp_prod1_image5','rxcp_prod1_image6','rxcp_prod1_image7','rxcp_prod1_image8','rxcp_prod1_image9','rxcp_prod1_image10','rxcp_prod1_doc1','rxcp_prod1_doc2','rxcp_prod1_doc3','rxcp_prod1_video1','rxcp_prod1_video2','rxcp_prod1_order','rxcp_prod1_enable','rxcp_prod1_created_at','rxcp_prod1_updated_at','rxcp_prod1_token','rxcp_cate1_category','rxcp_cate1_token')

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
// @return : int $rxcp_prod1_id
// @return: boolean false
//----------------------------------------------------------

public function insert_RXCP_Prod1_QY($onearray=null)
{
    $rxcp_prod1_id=null;

    if(isset($onearray) and is_iterable($onearray)){

        $rxcp_prod1_id = DB::table('rxcp_prod1')->insertGetId($onearray,'rxcp_prod1_id'); 
    }

    return $rxcp_prod1_id;
}

//----------------------------------------------------------
// UPDATE PRODUCTS
// @param : int $rxcp_prod1_id
// @param : int $rxcp_prod1_token
// @return: boolean
//----------------------------------------------------------

public function update_RXCP_Prod1_QY($onearray=null,$rxcp_prod1_id=null,$rxcp_prod1_token=null)
{
   $update=null;

    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){

        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){ 

            if(isset($onearray) and is_iterable($onearray)){

                $update = DB::table('rxcp_prod1')
                            ->where('rxcp_prod1_id',$rxcp_prod1_id)
                            ->where('rxcp_prod1_token',$rxcp_prod1_token)
                            ->update($onearray);                               
            }
        } 
    } 

    return $update;  
}

//----------------------------------------------------------
// DELETE PRODUCTS BY ID AND TOKEN
// @param : int $rxcp_prod1_id
// @param : int $rxcp_prod1_token
// @return: int $delete
//----------------------------------------------------------

public function delete_RXCP_Prod1_QY($rxcp_prod1_id=null,$rxcp_prod1_token=null)
{   

    $delete = false;

    if(isset($rxcp_prod1_id) and is_numeric($rxcp_prod1_id)){
        if(isset($rxcp_prod1_token) and is_string($rxcp_prod1_token)){

            $delete = DB::table('rxcp_prod1')
                        ->where('rxcp_prod1_id',$rxcp_prod1_id)
                        ->where('rxcp_prod1_token',$rxcp_prod1_token)
                        ->delete();
        }       
    } 

    return $delete;
}


//----------------------------------------------------------
// COUNT PRODUCTS BY CATEGORY ID
// @param : int $rxcp_cate1_id
// @param : string $rxcp_cate1_token
// @return: int $totalcount
//----------------------------------------------------------

public function countCategory_RXCP_Prod1_QY($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{   

    $totalcount = 0;

    if(isset($rxcp_cate_id) and is_numeric($rxcp_cate_id)){
        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            $totalcount = DB::table('rxcp_prod1')
                        ->where('rxcp_prod1_cate1_id',$rxcp_cate_id)
                        ->where('rxcp_cate1_token',$rxcp_cate1_token)
                        ->count();               
        } 
    } 

    return $totalcount;
}

//------------------------------------------------
}  