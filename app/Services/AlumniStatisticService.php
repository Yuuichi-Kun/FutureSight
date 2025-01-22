<?php

namespace App\Services;

use App\Models\Alumni;
use App\Models\StatusAlumni;
use App\Models\TracerKerja;
use App\Models\TracerKuliah;
use App\Models\Testimoni;

class AlumniStatisticService
{
    public function getAlumniStatistics()
    {
        $totalAlumni = Alumni::count();
        
        // Get statistics by status
        $statusStatistics = StatusAlumni::withCount('alumni')->get();
        
        // Get statistics by year
        $yearlyStatistics = Alumni::with('tahunLulus')
            ->select('id_tahun_lulus')
            ->selectRaw('count(*) as total')
            ->groupBy('id_tahun_lulus')
            ->get();
            
        // Get statistics by gender
        $genderStatistics = Alumni::select('jenis_kelamin')
            ->selectRaw('count(*) as total')
            ->groupBy('jenis_kelamin')
            ->get();

        return [
            'total_alumni' => $totalAlumni,
            'by_status' => $statusStatistics,
            'by_year' => $yearlyStatistics,
            'by_gender' => $genderStatistics
        ];
    }

    public function getAllStatistics(): array
    {
        return [
            'total_alumni' => $this->getTotalAlumni(),
            'total_bekerja' => $this->getTotalBekerja(),
            'total_kuliah' => $this->getTotalKuliah(),
            'response_rate' => $this->getResponseRate(),
            'gaji_stats' => $this->getGajiStats(),
            'bentuk_lembaga_stats' => $this->getBentukLembagaStats(),
        ];
    }

    private function getTotalAlumni(): int
    {
        return Alumni::count();
    }

    private function getTotalBekerja(): int
    {
        return TracerKerja::count();
    }

    private function getTotalKuliah(): int
    {
        return TracerKuliah::count();
    }

    private function getResponseRate(): float
    {
        $totalAlumni = $this->getTotalAlumni();
        if ($totalAlumni === 0) {
            return 0;
        }

        $totalResponden = $this->getTotalBekerja() + $this->getTotalKuliah();
        return round(($totalResponden / $totalAlumni) * 100, 2);
    }

    private function getGajiStats(): array
    {
        return TracerKerja::getGajiStats()->toArray();
    }

    private function getBentukLembagaStats(): array
    {
        return TracerKerja::getBentukLembagaStats()->toArray();
    }
} 