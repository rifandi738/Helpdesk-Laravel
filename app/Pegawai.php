<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'tbl_pegawai';

    protected $fillable = ['nama_pegawai','email','no_handphone','divisi_id','jabatan_id','user_id'];

    public function divisi(){

    return $this->belongsTo(Divisi::class, 'divisi_id', 'id');
    }

    public function jabatan(){

        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    // public function level(){

    //     return $this->belongsTo(level::class,'level_id', 'id');
    // }

    public function user(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}