<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Relationship: Category has many Assets
     * Satu kategori bisa punya banyak asset
     * Contoh: Kategori "Komputer" punya banyak komputer
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
