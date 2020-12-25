<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $table = 'posting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'harga', 'deskripsi', 'kondisi', 'lokasi', 'kategori'
    ];

}
