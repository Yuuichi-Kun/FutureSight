<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerKerja extends Model
{
    use HasFactory;

    protected $table = 'tbl_tracer_kerja';
    protected $primaryKey = 'id_tracer_kerja';

    protected $fillable = [
        'id_alumni',
        'tracer_kerja_pekerjaan',
        'tracer_kerja_nama',
        'jenis_perusahaan',
        'bentuk_lembaga',
        'tracer_kerja_jabatan',
        'tracer_kerja_status',
        'tracer_kerja_lokasi',
        'tracer_kerja_alamat',
        'tracer_kerja_tgl_mulai',
        'tracer_kerja_gaji'
    ];

    protected $casts = [
        'tracer_kerja_tgl_mulai' => 'date'
    ];

    // Relasi ke tabel alumni
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni', 'id_alumni');
    }

    // Scope untuk filter berdasarkan jenis perusahaan
    public function scopeJenisPerusahaan($query, $jenis)
    {
        return $query->where('jenis_perusahaan', $jenis);
    }

    // Scope untuk filter berdasarkan range gaji
    public function scopeRangeGaji($query, $range)
    {
        return $query->where('tracer_kerja_gaji', $range);
    }

    // Scope untuk filter berdasarkan status kerja
    public function scopeStatus($query, $status)
    {
        return $query->where('tracer_kerja_status', $status);
    }

    // Method untuk mendapatkan statistik gaji
    public static function getGajiStats()
    {
        return self::select('tracer_kerja_gaji', \DB::raw('count(*) as total'))
            ->groupBy('tracer_kerja_gaji')
            ->get();
    }

    // Method untuk mendapatkan statistik bentuk lembaga
    public static function getBentukLembagaStats()
    {
        return self::select('bentuk_lembaga', \DB::raw('count(*) as total'))
            ->groupBy('bentuk_lembaga')
            ->get();
    }
}