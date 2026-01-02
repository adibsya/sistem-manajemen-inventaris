<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name'];

    /**
     * Relationship: Room has many Assets
     * Satu ruangan bisa punya banyak asset
     * Contoh: Ruang Lab Komputer punya banyak komputer, meja, kursi
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
