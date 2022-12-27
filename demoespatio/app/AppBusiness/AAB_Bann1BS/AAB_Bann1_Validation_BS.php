<?php
declare(strict_types=1);

namespace App\AppBusiness\AAB_Bann1BS;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;


//use App\AppQuerys\M1L1_BannersQY;
//use App\AppUtils\UploadUT;
//use App\AppTokens\TokenTD;

//----------------------------------------------------------
// VALIDATE BANNERS 
//----------------------------------------------------------
// Class   : AAB_Bann1_Validation_BS, Restrict data input by using validation rules
// Used by : AAB_Bann1_Main_BS
//----------------------------------------------------------
// validateForm_AAB_Bann1_BS
// validateImagesForm_AAB_Bann1_BS

class AAB_Bann1_Validation_BS
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

public function validateForm_AAB_Bann1_BS($request)
{

    //validation logic
    $validated = $request->validate([
                 'aab_bann1_banner' => 'required|min:3|max:255',
                 'aab_bann1_title1' => 'required|min:3|max:255',
                 'aab_bann1_title2' => 'required|min:3|max:255',
                 'aab_bann1_title3' => 'required|min:3|max:255',                
                ]);
    
    return $validated;   
    
}

//----------------------------------------------------------
// VALIDATE IMAGES UPLOAD
// @param : 
// @return: object(Illuminate\Pagination\LengthAwarePaginator) 
// @return: null 
//----------------------------------------------------------

public function validateImagesForm_AAB_Bann1_BS($request)
{

    //validation logic
    $validated = $request->validate([
                 'aab_bann1_photo' => 'required'             
                ]);
    
    return $validated; 
        
}


//----------------------------------------------------------
}