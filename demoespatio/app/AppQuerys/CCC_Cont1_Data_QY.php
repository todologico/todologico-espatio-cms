<?php
declare(strict_types=1);

namespace App\AppQuerys;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\ccc_cont1;

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


class CCC_Cont1_Data_QY {

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

public function get_CCC_Cont1_QY($where=null,$orwhere=null,$orderby=null,$paginate=null,$limit=null)
{

    $records = DB::table('ccc_cont1')->select('ccc_cont1_id','ccc_cont1_name','ccc_cont1_surname','ccc_cont1_phone','ccc_cont1_cellphone','ccc_cont1_email','ccc_cont1_company','ccc_cont1_auxiliary1','ccc_cont1_auxiliary2','ccc_cont1_auxiliary3','ccc_cont1_auxiliary4','ccc_cont1_auxiliary5','ccc_cont1_text1','ccc_cont1_created_at','ccc_cont1_updated_at','ccc_cont1_token')

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
// DELETE CONTACT BY ID AND TOKEN
// @param : int $ccc_cont1_id
// @param : int $ccc_cont1_token
// @return: int $delete
//----------------------------------------------------------

public function delete_CCC_Cont1_QY($ccc_cont1_id=null,$ccc_cont1_token=null)
{   

    $delete = false;

    if(isset($ccc_cont1_id) and is_numeric($ccc_cont1_id)){
        if(isset($ccc_cont1_token) and is_string($ccc_cont1_token)){

            $delete = DB::table('ccc_cont1')
                        ->where('ccc_cont1_id',$ccc_cont1_id)
                        ->where('ccc_cont1_token',$ccc_cont1_token)
                        ->delete();
        }       
    } 

    return $delete;
}


//------------------------------------------------
}  