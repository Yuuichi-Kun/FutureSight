<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_bidang_keahlian';
    protected $primaryKey = 'id_bidang_keahlian';
    protected $fillable = ['kode_bidang_keahlian', 'bidang_keahlian'];

    public function programKeahlian()
    {
        return $this->hasMany(ProgramKeahlian::class, 'id_bidang_keahlian');
    }
}