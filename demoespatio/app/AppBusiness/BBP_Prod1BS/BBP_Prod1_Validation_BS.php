<?php
declare(strict_types=1);

namespace App\AppBusiness\BBP_Prod1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;


//use App\AppQuerys\M1L1_BannersQY;
//use App\AppUtils\UploadUT;
//use App\AppTokens\TokenTD;

//----------------------------------------------------------
// VALIDATE BB_P_PROD1 
//----------------------------------------------------------
// Class   : BBP_Prod1_Validation_BS, Restrict data input by using validation rules
// Used by : BBP_Prod1_Main_BS
//----------------------------------------------------------
// validateForm_BBP_Prod1_BS
// validateImagesForm_BBP_Prod1_BS

class BBP_Prod1_Validation_BS
{

//----------------------------------------------------------
// CONSTRUCTOR
//----------------------------------------------------------

public function __construct()
{

}

//----------------------------------------------------------
// VALIDATE DATA
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateForm_BBP_Prod1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'bbp_prod1_product' => 'required|min:3|max:255',
                 'bbp_prod1_title1'  => 'required|min:3|max:255',
                 'bbp_prod1_title2'  => 'required|min:3|max:255',
                 'bbp_prod1_title3'  => 'required|min:3|max:255',                
                 'bbp_prod1_price1'  => 'required|min:1|max:13',                
                 'bbp_prod1_code'    => 'required|min:1|max:60',                
                ]);
    
    return $validated; 
}

//----------------------------------------------------------
// VALIDATE IMAGES UPLOAD
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateImagesForm_BBP_Prod1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'bbp_prod1_photo' => 'required'             
                ]);
    
    return $validated; 
}

//----------------------------------------------------------
}