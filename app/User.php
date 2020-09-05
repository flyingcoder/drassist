<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Depsimon\Wallet\HasWallet;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Billable, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    protected static function boot() {
        
        parent::boot();
    
        static::created(function($model) { 
            $model->patients()->create([
                'name' => $model->name,
                'gender' => $model->gender,
                'health_card_province' => 'default',
                'date_of_birth' => $model->date_of_birth,
                'health_card' => 'default',
                'relationship' => 'null',
                'age' => $model->age,
                'certify' => true
            ]);
        });
    }
}
