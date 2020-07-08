<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $fillable = ['jenis_cuti','slug'];
    protected $dates = ['tanggal_awal','tanggal_akhir'];
    public function dosens(){
        return $this->belongsToMany(Dosen::class);
    }
}
