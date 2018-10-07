<?php

namespace App;

use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
   protected $fillable = ['transaction_id','btemp','bpressure','prate','rrate'];

   protected $hidden  = ['created_at' , 'updated_at' , 'transaction_id'];

   public function transaction()
   {
   	return $this->belongsTo(Transaction::class);
   }
}
