<?php

namespace App\Models;

use App\Http\Traits\UserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function jobsApplied(){
        return $this->belongsToMany(Job::class, 'jobs_users')->withTimestamps();
    }

    public function jobsFavorite(){
        return $this->belongsToMany(Job::class, 'favorites')->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role');
    }

    public function isAdmin()
    {
        return $this->roles->contains('name', 'admin');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

}
