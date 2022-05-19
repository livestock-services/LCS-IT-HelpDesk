<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    protected $table= "admins";

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','status'
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
