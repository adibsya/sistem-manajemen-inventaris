<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    protected $fillable = [
        'asset_id', 
        'user_id', 
        'description', 
        'photo_evidence', 
        'status'
    ];
}
