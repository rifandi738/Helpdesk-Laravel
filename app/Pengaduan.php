<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'tbl_pengaduan';

    protected $fillable = ['tanggal_pengaduan','image', 'keterangan', 'klien_id', 'status_id', 'aplikasi_id', 'modul_aplikasi_id','noted','image_noted'];
    
    protected $dates = ['created_at'];

    public function klien()
    {
        return $this->belongsTo(Klien::class, 'klien_id', 'id');
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class, 'aplikasi_id', 'id');
    }

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_aplikasi_id', 'id');
    }
}
