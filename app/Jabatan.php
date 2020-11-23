<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'tbl_jabatan';

    protected $fillable = ['kode_jabatan','nama_jabatan','divisi_id'];

    public $timestamps = false;


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'jabatan_id', 'id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id', 'id');
    }
}
