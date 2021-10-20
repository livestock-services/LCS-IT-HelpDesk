<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table= "admins";

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        //$this->notify(new AdminResetPasswordNotification($token));
    }
    public function posts(){
      //return $this->hasMany('App\Post');
    }
}
