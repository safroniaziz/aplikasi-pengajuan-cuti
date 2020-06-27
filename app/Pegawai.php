<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nip',
        'nm_pegawai',
        'jenis_kelamin',
        'departemen',
        'level_departemen',
        'jabatan',
        'cabang',
        'jenis_kepegawaian',
    ];
    public function cutis(){
        return $this->belongsToMany(Cuti::class);
    }
}
