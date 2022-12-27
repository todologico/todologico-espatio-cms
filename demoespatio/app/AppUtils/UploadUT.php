<?php

declare(strict_types=1);

namespace App\AppUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Facades\Storage;

//----------------------------------------------------------
// UPLOAD UTILITIES
//----------------------------------------------------------
// Class   : UploadUT, uploading files
// Used by : All
//----------------------------------------------------------

class UploadUT 
{

//----------------------------------------------------------
// UPLOAD FILES TO THE DISK AND RETURN AN ARRAY WITH THE FILES NAMES
// @param : array myfiles
// @return: array endfile
// @return: null 
//----------------------------------------------------------

/* return filenames with

        array(2) {
          [0]=>
          string(44) "LhuUvQTWSogrTLlKGPZE285KrzltcSMdQ9uFuPcp.jpg"
          [1]=>
          string(44) "LWYUDwDYDnMPGqDiIPcveGXFrVcJXU0RFS1TnmJE.jpg"
        }
*/  

public function UploadFileUT($myfiles = null)
{
    
    //----------------------------------------------------------
    // upload images
    //----------------------------------------------------------

    $filenames[]= null;

    if(isset($myfiles) and is_array($myfiles)){

        foreach($myfiles as $key => $onefile){            

            //uploading files
            try{

                $upfile  = $onefile->hashName();              
                $storage1=Storage::disk('public')->put('/uploaddir', $onefile); //image sftp 

                //save images names in array
                $filenames[$key]=$upfile;

            // I'll catch an error    
            } catch (Exception $e){

                $filenames[$key]=null;
            }            
            
                
        } //foreach 
        
    }   
    

    return $filenames;   
  
}

//----------------------------------------------------------
// UPLOAD IMAGES - call the store disk method (UploadFileUT) and return the images names (onearray)
// @param : $onearray
// @param : $xxx_zzz_image
// @param : $imagename  like 'aab_bann1_image'
// @return: onearray 
//----------------------------------------------------------

public function UploadArrayImageUT($onearray,$xxx_zzz_image,$imagename)
{

    if(isset($xxx_zzz_image)) {

        // store on disk: upload files - $imaxxx_zzz_imagege is array with images
        $filenames= $this->UploadFileUT($xxx_zzz_image);

      


        if(isset($filenames)){

            foreach ($filenames as $key => $filename) {

                if(isset($filename)){

                    //var_dump($key); exit;

                    //return images names
                    $mykey=$key+1;
                    $onearray[$imagename.$mykey] = $filename;

                }                        
            }  
        }
    } 

    return $onearray;
    
}



//----------------------------------------------------------
}