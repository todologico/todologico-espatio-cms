<?php
declare(strict_types=1);

namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\aab_bann1;

//----------------------------------------------------------
// AAB_Bann1_Data_QY - REPOSITORY PATTERN
//----------------------------------------------------------
// Model   : AAB_Bann1_Data_QY
// Used by : AAB_Bann1_Main_BS
//----------------------------------------------------------
// get_AAB_Bann1_QY
// insert_AAB_Bann1_QY
// update_AAB_Bann1_QY
// delete_AAB_Bann1_QY


class AAB_Bann1_Data_QY {

public function __construct()
{

}

//----------------------------------------------------------
// SELECT Bann1
// @param  : array $where
// @param  : array $orwhere
// @param  : array $orderby
// @param  : int $paginate
// @param  : int $limit
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: object(Illuminate\Support\Collection
//----------------------------------------------------------

public function get_AAB_Bann1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('aab_bann1')->select('aab_bann1_id','aab_bann1_banner','aab_bann1_title1','aab_bann1_title2','aab_bann1_title3','aab_bann1_image1','aab_bann1_image2','aab_bann1_order','aab_bann1_enable','aab_bann1_created_at','aab_bann1_updated_at','aab_bann1_token')

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
// @return : int $aab_bann1_id
// @return: boolean false
//----------------------------------------------------------

public function insert_AAB_Bann1_QY($onearray=null)
{
    $aab_bann1_id=null;

    if(isset($onearray) and is_iterable($onearray)){

        $aab_bann1_id = DB::table('aab_bann1')->insertGetId($onearray,'aab_bann1_id'); 
    }

    return $aab_bann1_id;
}

//----------------------------------------------------------
// UPDATE BANNER
// @param : int $aab_bann1_id
// @param : int $aab_bann1_token
// @return: boolean
//----------------------------------------------------------

public function update_AAB_Bann1_QY($onearray=null,$aab_bann1_id=null,$aab_bann1_token=null)
{
   $update=null;

    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){

        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){ 

            if(isset($onearray) and is_iterable($onearray)){

                $update = DB::table('aab_bann1')
                            ->where('aab_bann1_id',$aab_bann1_id)
                            ->where('aab_bann1_token',$aab_bann1_token)
                            ->update($onearray);                               
            }
        } 
    } 

    return $update;  
}

//----------------------------------------------------------
// DELETE BANNER BY ID AND TOKEN
// @param : int $aab_bann1_id
// @param : int $aab_bann1_token
// @return: int $delete
//----------------------------------------------------------

public function delete_AAB_Bann1_QY($aab_bann1_id=null,$aab_bann1_token=null)
{   

    $delete = false;

    if(isset($aab_bann1_id) and is_numeric($aab_bann1_id)){
        if(isset($aab_bann1_token) and is_string($aab_bann1_token)){

            $delete = DB::table('aab_bann1')
                        ->where('aab_bann1_id',$aab_bann1_id)
                        ->where('aab_bann1_token',$aab_bann1_token)
                        ->delete();
        }       
    } 

    return $delete;
}

//------------------------------------------------
}  