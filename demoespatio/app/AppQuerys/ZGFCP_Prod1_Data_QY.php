<?php
declare(strict_types=1);
namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\zgfcp_prod1;

//----------------------------------------------------------
// ZGFCP_Prod1_QY TM - REPOSITORY PATTERN
//----------------------------------------------------------
// Model   : ZGFCP_Prod1_Data_QY DB query builder
// Used by : ZGFCP_Prod1_Main_BS
//----------------------------------------------------------
// get_ZGFCP_Prod1_QY
// insert_ZGFCP_Prod1_QY
// update_ZGFCP_Prod1_QY
// delete_ZGFCP_Prod1_QY
// countCategory_ZGFCP_Prod1_QY
//----------------------------------------------------------

class ZGFCP_Prod1_Data_QY {

protected function __construct()
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

protected function get_ZGFCP_Prod1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('zgfcp_prod1')
    ->join('zgfcp_cate1', 'zgfcp_prod1.zgfcp_prod1_cate1_id', '=', 'zgfcp_cate1.zgfcp_cate1_id')
    ->join('zgfcp_fami1', 'zgfcp_prod1.zgfcp_prod1_fami1_id', '=', 'zgfcp_fami1.zgfcp_fami1_id')
    ->select('zgfcp_prod1_id','zgfcp_prod1_fami1_id','zgfcp_prod1_cate1_id','zgfcp_prod1_product','zgfcp_prod1_code','zgfcp_prod1_price1','zgfcp_prod1_title1','zgfcp_prod1_title2','zgfcp_prod1_title3','zgfcp_prod1_title4','zgfcp_prod1_title5','zgfcp_prod1_title6','zgfcp_prod1_text1','zgfcp_prod1_text2','zgfcp_prod1_text3','zgfcp_prod1_image1','zgfcp_prod1_image2','zgfcp_prod1_image3','zgfcp_prod1_image4','zgfcp_prod1_image5','zgfcp_prod1_image6','zgfcp_prod1_image7','zgfcp_prod1_image8','zgfcp_prod1_image9','zgfcp_prod1_image10','zgfcp_prod1_doc1','zgfcp_prod1_doc2','zgfcp_prod1_doc3','zgfcp_prod1_video1','zgfcp_prod1_video2','zgfcp_prod1_order','zgfcp_prod1_enable','zgfcp_prod1_created_at','zgfcp_prod1_updated_at','zgfcp_prod1_token','zgfcp_cate1_category','zgfcp_cate1_token','zgfcp_fami1_family','zgfcp_fami1_token')

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
// @return : int $zgfcp_prod1_id
// @return: boolean false
//----------------------------------------------------------

protected function insert_ZGFCP_Prod1_QY($onearray=null)
{
    $zgfcp_prod1_id=null;

    if(isset($onearray) and is_iterable($onearray)){

        $zgfcp_prod1_id = DB::table('zgfcp_prod1')->insertGetId($onearray,'zgfcp_prod1_id'); 
    }

    return $zgfcp_prod1_id;
}

//----------------------------------------------------------
// UPDATE PRODUCTS
// @param : int $zgfcp_prod1_id
// @param : int $zgfcp_prod1_token
// @return: boolean
//----------------------------------------------------------

protected function update_ZGFCP_Prod1_QY($onearray=null,$zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{
   $update=null;

    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){

        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){ 

            if(isset($onearray) and is_iterable($onearray)){

                $update = DB::table('zgfcp_prod1')
                            ->where('zgfcp_prod1_id',$zgfcp_prod1_id)
                            ->where('zgfcp_prod1_token',$zgfcp_prod1_token)
                            ->update($onearray);                               
            }
        } 
    } 

    return $update;  
}

//----------------------------------------------------------
// DELETE PRODUCTS BY ID AND TOKEN
// @param : int $zgfcp_prod1_id
// @param : int $zgfcp_prod1_token
// @return: int $delete
//----------------------------------------------------------

protected function delete_ZGFCP_Prod1_QY($zgfcp_prod1_id=null,$zgfcp_prod1_token=null)
{   

    $delete = false;

    if(isset($zgfcp_prod1_id) and is_numeric($zgfcp_prod1_id)){
        if(isset($zgfcp_prod1_token) and is_string($zgfcp_prod1_token)){

            $delete = DB::table('zgfcp_prod1')
                        ->where('zgfcp_prod1_id',$zgfcp_prod1_id)
                        ->where('zgfcp_prod1_token',$zgfcp_prod1_token)
                        ->delete();
        }       
    } 

    return $delete;
}


//----------------------------------------------------------
// COUNT PRODUCTS BY CATEGORY ID
// @param : int $zgfcp_cate1_id
// @param : string $zgfcp_cate1_token
// @return: int $totalcount
//----------------------------------------------------------

protected function countCategory_ZGFCP_Prod1_QY($zgfcp_cate1_id=null,$zgfcp_cate1_token=null)
{   

    $totalcount = 0;

    if(isset($zgfcp_cate_id) and is_numeric($zgfcp_cate_id)){
        if(isset($zgfcp_cate1_token) and is_string($zgfcp_cate1_token)){

            $totalcount = DB::table('zgfcp_prod1')
                        ->where('zgfcp_prod1_cate1_id',$zgfcp_cate_id)
                        ->where('zgfcp_cate1_token',$zgfcp_cate1_token)
                        ->count();               
        } 
    } 

    return $totalcount;
}

//------------------------------------------------
}  