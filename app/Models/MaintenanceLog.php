<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    protected $fillable = [
        'asset_id', 
        'user_id', 
        'action_taken', 
        'cost', 
        'completion_date'
    ];
}
