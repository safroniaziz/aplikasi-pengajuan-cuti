<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Operator extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fak_kode_univ',
        'nm_fakultas',
        'slug',
        'password'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}