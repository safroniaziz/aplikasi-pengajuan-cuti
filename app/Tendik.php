<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    protected $fillable = [
        'nik','nm_tendik','slug','jenis_kelamin','cabang_id','cabang_nama','dept_id','dept_nama','jenis_kepegawaian'
    ];
}
