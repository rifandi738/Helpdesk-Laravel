<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    protected $table = 'tbl_aplikasi';

    protected $fillable = ['nama_aplikasi'];

    public $timestamps = false;


    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'aplikasi_id', 'id');
    }
}
