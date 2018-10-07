<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
     protected $guarded  = [];


     public function purchases()
     {
     	return $this->hasMany(MedPurchase::class);
     }

     public function orders()
     {
     	return $this->hasMany(MedOrder::class);
     }
}
