<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rxcp_prod1 extends Model
{
    use HasFactory;

    protected $table = 'rxcp_prod1';

    protected $primaryKey = 'rxcp_prod1_id';

    const CREATED_AT = 'rxcp_prod1_created_at';
    
    const UPDATED_AT = 'rxcp_prod1_updated_at';

    protected $fillable = ['*'];
}
