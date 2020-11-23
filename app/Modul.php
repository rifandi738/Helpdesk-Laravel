<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'tbl_modul_aplikasi';

    protected $fillable = ['nama_modul', 'aplikasi_id'];

    public $timestamps = false;

   public function aplikasi()
   {
       return $this->belongsTo(Aplikasi::class, 'aplikasi_id', 'id');
   }

   public function pengaduan()
   {
       return $this->hasMany(Pengaduan::class, 'modul_aplikasi_id', 'id');
   }
}
