<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bbp_prod1 extends Model
{
    use HasFactory;

    protected $table = 'bbp_prod1';

    protected $primaryKey = 'bbp_prod1_id';

    const CREATED_AT = 'bbp_prod1_created_at';
    
    const UPDATED_AT = 'bbp_prod1_updated_at';

}
