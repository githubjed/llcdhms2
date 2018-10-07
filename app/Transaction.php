<?php

namespace App;

use App\Vital;
use App\helpers\TokenHelper;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     // protected $fillable = ['patient_trans_id','patient_id','incharge_doc','wardName','bedNo','date_discharge','date_incharge','findings','prescription','totalBills','patientStatus','tenderAmount','change','amountDisc','totalDiscounted','typeOfDiscount','DiscountedId','SponsorOfDiscount','admitDiagnos'];

	protected $guarded = [];

	// protected static function boot()
	// {

 //    parent::boot();
 //    static::creating(function ($model) {
 //            $model->{$model->getKeyName()} = (string)$model->generateNewId();
 //        });
 //    }
    
 //    public function generateNewId()
 //    {
 //        return auth()->user()->id . TokenHelper::activationCode(array( 'length' => 10, 'alphanumeric' => false));
 //    }

	public function vital()
	{
		return $this->hasOne(Vital::class);
	}

	// public function getInchargeDocAttribute($value)
	// {
	// 	return User::find($value);
	// }

}
