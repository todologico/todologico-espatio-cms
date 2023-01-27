<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zgfcp_fami1 extends Model
{
    use HasFactory;

    protected $table = 'zgfcp_fami1';

    protected $primaryKey = 'zgfcp_fami1_id';

    const CREATED_AT = 'zgfcp_fami1_created_at';
    
    const UPDATED_AT = 'zgfcp_fami1_updated_at';

    protected $fillable = ['*'];
}
