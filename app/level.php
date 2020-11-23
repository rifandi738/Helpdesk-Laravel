<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    protected $table = 'tbl_level';

    protected $fillable = ['level'];

        public function user()
        {
            return $this->hasOne(User::class, 'level_id', 'id');
        }

        
}
