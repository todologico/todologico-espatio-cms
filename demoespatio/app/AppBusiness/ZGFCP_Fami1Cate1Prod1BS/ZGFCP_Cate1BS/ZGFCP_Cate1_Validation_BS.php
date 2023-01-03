<?php
declare(strict_types=1);

namespace App\AppBusiness\ZGFCP_Fami1Cate1Prod1BS\ZGFCP_Cate1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;


//use App\AppQuerys\M1L1_BannersQY;
//use App\AppUtils\UploadUT;
//use App\AppTokens\TokenTD;

//----------------------------------------------------------
// VALIDATE ZGFCP_Cate1_BS 
//----------------------------------------------------------
// Class   : ZGFCP_Cate1_Validation_BS, Restrict data input by using validation rules
// Used by : ZGFCP_Cate1_Main_BS
//----------------------------------------------------------
// validateForm_ZGFCP_Cate1_BS
// validateImagesForm_ZGFCP_Cate1_BS

class ZGFCP_Cate1_Validation_BS
{

//----------------------------------------------------------
// VALIDATE DATA
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateForm_ZGFCP_Cate1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'zgfcp_cate1_category'  => 'required|min:3|max:255',
                 'zgfcp_cate1_title1'    => 'required|min:3|max:255',
                 'zgfcp_cate1_title2'    => 'required|min:3|max:255',
                ]);
    
    return $validated;
        
}

//----------------------------------------------------------
// VALIDATE IMAGES UPLOAD
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateImagesForm_ZGFCP_Cate1_BS($request)
{
    //validation logic
    $validated = $request->validate([
                 'zgfcp_cate1_photo' => 'required'             
                ]);
    
    return $validated; 
}

//----------------------------------------------------------
}