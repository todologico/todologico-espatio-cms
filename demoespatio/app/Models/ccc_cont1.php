<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ccc_cont1 extends Model
{
    use HasFactory;

    protected $table = 'ccc_cont1';

    protected $primaryKey = 'ccc_cont1_id';

    const CREATED_AT = 'ccc_cont1_created_at';
    
    const UPDATED_AT = 'ccc_cont1_updated_at';
   
    protected $fillable =['ccc_cont1_name','ccc_cont1_surname','ccc_cont1_phone','ccc_cont1_cellphone','ccc_cont1_email','ccc_cont1_company','ccc_cont1_auxiliary1','ccc_cont1_auxiliary2','ccc_cont1_auxiliary3','ccc_cont1_auxiliary4','ccc_cont1_auxiliary5','ccc_cont1_text1','ccc_cont1_enable','ccc_cont1_created_at','ccc_cont1_updated_at','ccc_cont1_token']; 

}