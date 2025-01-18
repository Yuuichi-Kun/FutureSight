<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusAlumni;

class StatusAlumniSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['status_alumni' => 'Kuliah'],
            ['status_alumni' => 'Bekerja'],
            ['status_alumni' => 'Pengangguran'],
        ];

        foreach ($statuses as $status) {
            StatusAlumni::create($status);
        }
    }
}