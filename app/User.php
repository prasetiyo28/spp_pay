<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';

    protected $primarykey='id';

    protected $fillable = [
        'nama', 'email', 'password','siswa_id'
    ];
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

    public function isSuperadmin()
    {
        if ($this->role == 'superadmin') {
            return true;
        }

        return false;
    }

    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        }

        return false;
    }

    public function isSiswa()
    {
        if ($this->role == 'siswa') {
            return true;
        }

        return false;
    }

    // public function siswa() 
    // {
    //     return $this->belongsTo('App\Models\Siswa', 'user_id');
    // }
}
