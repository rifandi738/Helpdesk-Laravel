<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'tbl_user';  
    
    protected $fillable = [
        'username', 'password','level_id'
    ];

    // protected $guarded = array();

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    public function level()
    {
        return $this->belongsTo(level::class, 'level_id', 'id');
    }

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class,'user_id', 'id');
    }

    public function klien()
    {
        return $this->hasOne(Klien::class,'user_id', 'id');
    }



    
}
