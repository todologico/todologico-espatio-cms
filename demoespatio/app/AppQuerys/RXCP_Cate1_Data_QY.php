<?php
declare(strict_types=1);

namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\rxcp_cate1;

//----------------------------------------------------------
// RXCP_Cate1QY TM - REPOSITORY PATTERN
//----------------------------------------------------------
// Model   : RXCP_Cate1_Data_QY DB query builder
// Used by : RXCP_Cate1_Main_BS
//----------------------------------------------------------
// countProductsCategories_RXCP_Cate1_QY
// get_RXCP_Cate1_QY
// insert_RXCP_Cate1_QY
// update_RXCP_Cate1_QY
// delete_RXCP_Cate1_QY

class RXCP_Cate1_Data_QY {

public function __construct()
{

}

//----------------------------------------------------------
// SELECT COUNT PROD1 X CATE1
// @param  : void
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------

public function countProductsCategories_RXCP_Cate1_QY(){

    //counting the products of each category
    $records=  DB::table('rxcp_cate1')
                ->join('rxcp_prod1', 'rxcp_prod1.rxcp_prod1_cate1_id', '=', 'rxcp_cate1.rxcp_cate1_id')
                ->selectRaw('rxcp_cate1_category,rxcp_cate1_id,count(rxcp_prod1_id) as numprod1')
                ->groupBy('rxcp_prod1_cate1_id','rxcp_cate1_category','rxcp_cate1_id')
                ->get(); 

    return $records;
}

//----------------------------------------------------------
// SELECT RXCP_CATE1
// @param  : array $where
// @param  : array $orwhere
// @param  : array $orderby
// @param  : int $paginate
// @param  : int $limit
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------

public function get_RXCP_Cate1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('rxcp_cate1')->select('rxcp_cate1_id','rxcp_cate1_category','rxcp_cate1_title1','rxcp_cate1_title2','rxcp_cate1_text1','rxcp_cate1_image1','rxcp_cate1_image2','rxcp_cate1_order','rxcp_cate1_enable','rxcp_cate1_created_at','rxcp_cate1_updated_at','rxcp_cate1_token')

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
// INSERT BANNER
// @param : array $onearray
// @return : int $rxcp_cate1_id
// @return: boolean false
//----------------------------------------------------------

public function insert_RXCP_Cate1_QY($onearray=null)
{
    $rxcp_cate1_id=null;

    if(isset($onearray) and is_iterable($onearray)){

        $rxcp_cate1_id = DB::table('rxcp_cate1')->insertGetId($onearray,'rxcp_cate1_id'); 
    }

    return $rxcp_cate1_id;
}

//----------------------------------------------------------
// UPDATE BANNER
// @param : int $rxcp_cate1_id
// @param : int $rxcp_cate1_token
// @return: boolean
//----------------------------------------------------------

public function update_RXCP_Cate1_QY($onearray=null,$rxcp_cate1_id=null,$rxcp_cate1_token=null)
{
   $update=null;

    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){

        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){ 

            if(isset($onearray) and is_iterable($onearray)){

                $update = DB::table('rxcp_cate1')
                            ->where('rxcp_cate1_id',$rxcp_cate1_id)
                            ->where('rxcp_cate1_token',$rxcp_cate1_token)
                            ->update($onearray);                               
            }
        } 
    } 

    return $update;  
}

//----------------------------------------------------------
// DELETE BANNER BY ID AND TOKEN
// @param : int $rxcp_cate1_id
// @param : int $rxcp_cate1_token
// @return: int $delete
//----------------------------------------------------------

public function delete_RXCP_Cate1_QY($rxcp_cate1_id=null,$rxcp_cate1_token=null)
{   

    $delete = false;

    if(isset($rxcp_cate1_id) and is_numeric($rxcp_cate1_id)){
        if(isset($rxcp_cate1_token) and is_string($rxcp_cate1_token)){

            $delete = DB::table('rxcp_cate1')
                        ->where('rxcp_cate1_id',$rxcp_cate1_id)
                        ->where('rxcp_cate1_token',$rxcp_cate1_token)
                        ->delete();
        }       
    } 

    return $delete;
}

//------------------------------------------------
}  