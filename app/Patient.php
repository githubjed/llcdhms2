<?php

namespace App;

use App\helpers\TokenHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    protected $guarded  = [];
    public $incrementing = false;

    protected static function boot()
    {
    parent::boot();
    static::creating(function ($model) {
    		if (!$model->find((string)$model->generateNewId())) {
           		 $model->{$model->getKeyName()} = (string)$model->generateNewId();
    		};
        });
    }

    public function generateNewId()
    {
    	$id =  DB::table('patients')
	                ->orderBy('created_at', 'desc')
	                ->get();

        $id = count($id) ? $id->first()->id : 0;

    	$value = (integer)$id + 1;
    	return str_pad((string)$value, 6, '0', STR_PAD_LEFT);
    }

    public function getPatientTypeAttribute($value)
    {
        return $value == 0 ? "Out-Patient" : "In-Patient";
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
