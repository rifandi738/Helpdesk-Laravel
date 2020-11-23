<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'tbl_status';

    protected $fillable = ['id','nama_status'];

    public $timestamps = false;


    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'status_id', 'id');
    }

}
