<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zgfcp_prod1 extends Model
{
    use HasFactory;

    protected $table = 'zgfcp_prod1';
    
    protected $primaryKey = 'zgfcp_prod1_id';

    const CREATED_AT = 'zgfcp_prod1_created_at';
    
    const UPDATED_AT = 'zgfcp_prod1_updated_at';
}
