<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawStudent extends Model
{
    use HasFactory;

    protected $table = 'tbl_raw_students';
    protected $primaryKey = 'id_raw_student';
    
    protected $fillable = [
        'nisn',
        'nik',
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'tgl_lahir',
        'alamat'
    ];

    protected $dates = ['tgl_lahir'];

    protected $casts = [
        'tgl_lahir' => 'date'
    ];
} 