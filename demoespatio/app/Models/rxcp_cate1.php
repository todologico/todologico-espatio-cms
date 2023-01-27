<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rxcp_cate1 extends Model
{
    use HasFactory;

    protected $table = 'rxcp_cate1';

    protected $primaryKey = 'rxcp_cate1_id';

    const CREATED_AT = 'rxcp_cate1_created_at';
    
    const UPDATED_AT = 'rxcp_cate1_updated_at';

    protected $fillable =['rxcp_cate1_category','rxcp_cate1_title1','rxcp_cate1_title2','rxcp_cate1_text1','rxcp_cate1_image1','rxcp_cate1_image2','rxcp_cate1_order','rxcp_cate1_enable','rxcp_cate1_created_at','rxcp_cate1_updated_at','rxcp_cate1_token']; 

}
