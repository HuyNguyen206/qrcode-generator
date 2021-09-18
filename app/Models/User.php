<?php

namespace App\Models;

use App\Models\Traits\UserPermissionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, UserPermissionTrait;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function qrcodes()
    {
        return $this->hasMany(Qrcode::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function accountHistories()
    {
        return $this->hasMany(AccountHistory::class);
    }



}
