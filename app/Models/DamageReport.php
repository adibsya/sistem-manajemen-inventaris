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

    /**
     * Relationship: DamageReport belongs to an Asset
     * Laporan kerusakan ini untuk asset mana
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Relationship: DamageReport belongs to a User
     * Siapa staff yang membuat laporan ini
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
