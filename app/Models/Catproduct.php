<?php

namespace App;



//use Illuminate\Auth\Authenticatable;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Laravel\Lumen\Auth\Authorizable;

class Catproduct extends Model
{
//   use Authenticatable, Authorizable, HasFactory;
//  public $table = "";
  public function product()
 {
     return $this->hasMany(Product::class);
 }
}
