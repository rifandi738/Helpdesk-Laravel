<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'tbl_divisi';
    
    protected $fillable = ['kode_divisi','nama_divisi'];

    public $timestamps = false;


    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'divisi_id', 'id');
    }

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'divisi_id', 'id');
    }
}
