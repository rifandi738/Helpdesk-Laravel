<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    protected $table = 'tbl_klien';

    protected $fillable = ['nama_perusahaan', 'email', 'no_telpon', 'alamat','user_id', 'level_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo(level::class, 'user_id', 'id');
    }

    public function operator()
    {
        return $this->hasOne(Operator::class, 'klien_id', 'id');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'klien_id', 'id');
    }
}
