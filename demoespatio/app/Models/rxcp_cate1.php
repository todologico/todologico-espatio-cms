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
}
