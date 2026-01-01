<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable =['category_id','room_id','code','name','brand','purchase_date','condition'];
}
