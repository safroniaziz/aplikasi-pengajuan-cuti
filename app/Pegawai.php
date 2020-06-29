<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nip',
        'nm_pegawai',
        'slug',
        'jenis_kelamin',
        'departemen',
        'level_departemen',
        'jabatan',
        'cabang',
        'jenis_kepegawaian',
    ];
    public function cutis(){
        return $this->belongsToMany(Cuti::class)->withPivot('id','tanggal_awal','tanggal_akhir','keterangan','file_ajuan','status')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
