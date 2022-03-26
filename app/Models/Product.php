<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

   public $table = "product";
    public function user()
    {
        return $this->belongsTo(Catproduct::class);
    }
}
