<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['category_id', 'room_id', 'code', 'name', 'brand', 'purchase_date', 'condition'];

    /**
     * Relationship: Asset belongs to a Category
     * Satu asset punya satu kategori (misal: Komputer, Meja, dll)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: Asset belongs to a Room
     * Satu asset berada di satu ruangan
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relationship: Asset has many DamageReports
     * Satu asset bisa punya banyak laporan kerusakan
     */
    public function damageReports()
    {
        return $this->hasMany(DamageReport::class);
    }

    /**
     * Relationship: Asset has many MaintenanceLogs
     * Satu asset bisa punya banyak riwayat perbaikan
     */
    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}
