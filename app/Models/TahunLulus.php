<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunLulus extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_tahun_lulus';
    protected $primaryKey = 'id_tahun_lulus';
    protected $fillable = ['tahun_lulus', 'keterangan'];
}