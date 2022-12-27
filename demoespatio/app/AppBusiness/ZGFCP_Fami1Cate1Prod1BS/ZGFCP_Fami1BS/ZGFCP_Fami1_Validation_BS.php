<?php
declare(strict_types=1);

namespace App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Fami1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;


//use App\AppQuerys\M1L1_BannersQY;
//use App\AppUtils\UploadUT;
//use App\AppTokens\TokenTD;

//----------------------------------------------------------
// VALIDATE ZGFCP_Fami1_BS 
//----------------------------------------------------------
// Class   : ZGFCP_Fami1_Validation_BS
// Used by : ZGFCP_Fami1_Main_BS
//----------------------------------------------------------
// validateForm_ZGFCP_Fami1_BS
// validateImagesForm_ZGFCP_Fami1_BS

class ZGFCP_Fami1_Validation_BS
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

public function validateForm_ZGFCP_Fami1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'zgfcp_fami1_family'  => 'required|min:3|max:255',
                 'zgfcp_fami1_title1'    => 'required|min:3|max:255',
                 'zgfcp_fami1_title2'    => 'required|min:3|max:255',
                ]);
    
    return $validated;
        
}

//----------------------------------------------------------
// VALIDATE IMAGES UPLOAD
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateImagesForm_ZGFCP_Fami1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'zgfcp_fami1_photo' => 'required'             
                ]);
    
    return $validated; 
}

//----------------------------------------------------------
}