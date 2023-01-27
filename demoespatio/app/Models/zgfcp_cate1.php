<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zgfcp_cate1 extends Model
{
    use HasFactory;

    protected $table = 'zgfcp_cate1';

    protected $primaryKey = 'zgfcp_cate1_id';

    const CREATED_AT = 'zgfcp_cate1_created_at';
    
    const UPDATED_AT = 'zgfcp_cate1_updated_at';

    protected $fillable = ['*'];
}
