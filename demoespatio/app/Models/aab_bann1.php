<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aab_bann1 extends Model
{
    use HasFactory;

    
    protected $table = 'aab_bann1';

    protected $primaryKey = 'aab_bann1_id';

    const CREATED_AT = 'aab_bann1_created_at';
    
    const UPDATED_AT = 'aab_bann1_updated_at';

    protected $guarded = [];

    // protected $fillable = ['aab_bann1_banner'];
    // protected $fillable = ['aab_bann1_title1'];
    // protected $fillable = ['aab_bann1_title2'];
    // protected $fillable = ['aab_bann1_title3'];
    // protected $fillable = ['aab_bann1_enable'];

}
