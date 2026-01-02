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

    /**
     * Relationship: MaintenanceLog belongs to an Asset
     * Log perbaikan ini untuk asset mana
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Relationship: MaintenanceLog belongs to a User
     * Siapa teknisi yang melakukan perbaikan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
