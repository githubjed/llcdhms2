<?php

namespace App;

use App\helpers\TokenHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [  'user_id', 
        'name', 'email', 'password', 'user_type',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role' , 'pivot'
    ];

    // protected static function boot()
    // {
    // parent::boot();
    // static::creating(function ($model) {
    //         $model->{$model->getKeyName()} = (string)$model->generateNewId();
    //     });
    // }
    
    // public function generateNewId()
    // {
    //     return TokenHelper::activationCode(array( 'length' => 20, 'alphanumeric' => false));
    // }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getUserTypeAttribute()
    {
        return $this->role->first()->name;
    }

    public function getUserStatusAttribute()
     {
        return $this->deleted_at == null ? 'Active' : 'Inactive';
    }

}
