<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumni extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'tbl_alumni';
    protected $primaryKey = 'id_alumni';
    protected $guarded = ['id_alumni'];
    
    protected $hidden = [
        'password',
    ];

    public function tahunLulus()
    {
        return $this->belongsTo(TahunLulus::class, 'id_tahun_lulus');
    }

    public function konsentrasiKeahlian()
    {
        return $this->belongsTo(KonsentrasiKeahlian::class, 'id_konsentrasi_keahlian');
    }

    public function statusAlumni()
    {
        return $this->belongsTo(StatusAlumni::class, 'id_status_alumni');
    }
}
