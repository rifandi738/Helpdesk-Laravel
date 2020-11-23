<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = 'tbl_operator';

    protected $fillable = ['nama_operator','klien_id'];
   
    public $timestamps = false;

    public function klien()
    {
        return $this->belongsTo(Klien::class, 'klien_id', 'id');
    }
}
