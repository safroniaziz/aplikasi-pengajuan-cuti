<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'nip','nm_dosen','slug','gelar_depan','gelar_belakang','jenis_kelamin','prodi_kode','prodi_nama','fakultas_kode','fakultas_nama','departemen_id','departemen_nama'
    ];

    public function cutis(){
        return $this->belongsToMany(Cuti::class)->withPivot('id','tanggal_awal','tanggal_akhir','keterangan','file_ajuan','status')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
