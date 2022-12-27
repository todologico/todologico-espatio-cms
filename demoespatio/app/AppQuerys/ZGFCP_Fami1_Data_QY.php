<?php
declare(strict_types=1);
namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\zgfcp_fami1;

//----------------------------------------------------------
// ZGFCP_Fami1QY TM - REPOSITORY PATTERN
//----------------------------------------------------------
// Model   : ZGFCP_Fami1_Data_QY
// Used by : ZGFCP_Fami1_Main_BS
//----------------------------------------------------------
// countProductsFamilies_ZGFCP_Fami1_QY
// get_ZGFCP_Fami1_QY
// insert_ZGFCP_Fami1_QY
// update_ZGFCP_Fami1_QY
// delete_ZGFCP_Fami1_QY

class ZGFCP_Fami1_Data_QY {

public function __construct()
{

}

//----------------------------------------------------------
// SELECT COUNT PROD1 X CATE1
// @param  : void
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------

public function countCategoriesxFamilies_ZGFCP_Fami1_QY(){

    //counting the categories of each family
    $records=  DB::table('zgfcp_fami1')
                ->join('zgfcp_cate1', 'zgfcp_cate1.zgfcp_cate1_fami1_id', '=', 'zgfcp_fami1.zgfcp_fami1_id')
                ->selectRaw('zgfcp_fami1_family,zgfcp_fami1_id,count(zgfcp_cate1_id) as numcate1')
                ->groupBy('zgfcp_cate1_fami1_id','zgfcp_fami1_family','zgfcp_fami1_id')
                ->get(); 

    return $records;
}


public function countProductsxFamilies_ZGFCP_Fami1_QY(){

    //counting the products of each family
    $records=  DB::table('zgfcp_fami1')
                ->join('zgfcp_prod1', 'zgfcp_prod1.zgfcp_prod1_fami1_id', '=', 'zgfcp_fami1.zgfcp_fami1_id')
                ->selectRaw('zgfcp_fami1_family,zgfcp_fami1_id,count(zgfcp_prod1_id) as numprod1')
                ->groupBy('zgfcp_prod1_fami1_id','zgfcp_fami1_family','zgfcp_fami1_id')
                ->get(); 

    return $records;
}
//----------------------------------------------------------
// SELECT get_ZGFCP_Fami1_QY
// @param  : array $where
// @param  : array $orwhere
// @param  : array $orderby
// @param  : int $paginate
// @param  : int $limit
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------

public function get_ZGFCP_Fami1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('zgfcp_fami1')->select('zgfcp_fami1_id','zgfcp_fami1_family','zgfcp_fami1_title1','zgfcp_fami1_title2','zgfcp_fami1_text1','zgfcp_fami1_image1','zgfcp_fami1_image2','zgfcp_fami1_order','zgfcp_fami1_enable','zgfcp_fami1_created_at','zgfcp_fami1_updated_at','zgfcp_fami1_token')

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
// INSERT FAMILY
// @param : array $onearray
// @return : int $zgfcp_fami1_id
// @return: boolean false
//----------------------------------------------------------

public function insert_ZGFCP_Fami1_QY($onearray=null)
{
    $zgfcp_fami1_id=null;

    if(isset($onearray) and is_iterable($onearray)){

        $zgfcp_fami1_id = DB::table('zgfcp_fami1')->insertGetId($onearray,'zgfcp_fami1_id'); 
    }

    return $zgfcp_fami1_id;
}

//----------------------------------------------------------
// UPDATE FAMILY
// @param : int $zgfcp_fami1_id
// @param : int $zgfcp_fami1_token
// @return: boolean
//----------------------------------------------------------

public function update_ZGFCP_Fami1_QY($onearray=null,$zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{
   $update=null;

    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){

        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){ 

            if(isset($onearray) and is_iterable($onearray)){

                $update = DB::table('zgfcp_fami1')
                            ->where('zgfcp_fami1_id',$zgfcp_fami1_id)
                            ->where('zgfcp_fami1_token',$zgfcp_fami1_token)
                            ->update($onearray);                               
            }
        } 
    } 

    return $update;  
}

//----------------------------------------------------------
// DELETE FAMILY BY ID AND TOKEN
// @param : int $zgfcp_fami1_id
// @param : int $zgfcp_fami1_token
// @return: int $delete
//----------------------------------------------------------

public function delete_ZGFCP_Fami1_QY($zgfcp_fami1_id=null,$zgfcp_fami1_token=null)
{   

    $delete = false;

    if(isset($zgfcp_fami1_id) and is_numeric($zgfcp_fami1_id)){
        if(isset($zgfcp_fami1_token) and is_string($zgfcp_fami1_token)){

            $delete = DB::table('zgfcp_fami1')
                        ->where('zgfcp_fami1_id',$zgfcp_fami1_id)
                        ->where('zgfcp_fami1_token',$zgfcp_fami1_token)
                        ->delete();
        }       
    } 

    return $delete;
}

//------------------------------------------------
}  