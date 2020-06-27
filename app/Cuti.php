<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $fillable = ['jenis_cuti','slug'];
    public function pegawais(){
        return $this->belongsToMany(Pegawai::class);
    }
}
