<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $fillable = ['jenis_cuti'];
    public function pegawais(){
        return $this->belongsToMany(Pegawai::class);
    }
}
