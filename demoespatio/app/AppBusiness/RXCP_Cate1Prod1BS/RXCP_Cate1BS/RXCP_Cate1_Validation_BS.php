<?php
declare(strict_types=1);

namespace App\AppBusiness\RXCP_Cate1Prod1BS\RXCP_Cate1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;


//use App\AppQuerys\M1L1_BannersQY;
//use App\AppUtils\UploadUT;
//use App\AppTokens\TokenTD;

//----------------------------------------------------------
// VALIDATE RXCP_Cate1_BS 
//----------------------------------------------------------
// Class   : RXCP_Cate1_Validation_BS, Restrict data input by using validation rules
// Used by : RXCP_Cate1_Main_BS
//----------------------------------------------------------
// validateForm_RXCP_Cate1_BS
// validateImagesForm_RXCP_Cate1_BS

class RXCP_Cate1_Validation_BS
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

public function validateForm_RXCP_Cate1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'rxcp_cate1_category'  => 'required|min:3|max:255',
                 'rxcp_cate1_title1'    => 'required|min:3|max:255',
                 'rxcp_cate1_title2'    => 'required|min:3|max:255',
                ]);
    
    return $validated;
        
}

//----------------------------------------------------------
// VALIDATE IMAGES UPLOAD
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateImagesForm_RXCP_Cate1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'rxcp_cate1_photo' => 'required'             
                ]);
    
    return $validated; 
}

//----------------------------------------------------------
}