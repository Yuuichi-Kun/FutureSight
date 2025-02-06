<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RawStudent;

class RawStudentsSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'nisn' => '0123456789',
                'nik' => '3171234567890001',
                'nama_depan' => 'Ahmad',
                'nama_belakang' => 'Fauzi',
            ],
            [
                'nisn' => '0123456790',
                'nik' => '3171234567890002',
                'nama_depan' => 'Siti',
                'nama_belakang' => 'Rahmawati',
            ],
            [
                'nisn' => '0123456791',
                'nik' => '3171234567890003',
                'nama_depan' => 'Muhammad',
                'nama_belakang' => 'Rizki',
            ],
            [
                'nisn' => '0123456792',
                'nik' => '3171234567890004',
                'nama_depan' => 'Dewi',
                'nama_belakang' => 'Safitri',
            ],
            [
                'nisn' => '0123456793',
                'nik' => '3171234567890005',
                'nama_depan' => 'Budi',
                'nama_belakang' => 'Santoso',
            ],
            [
                'nisn' => '0123456794',
                'nik' => '3171234567890006',
                'nama_depan' => 'Rina',
                'nama_belakang' => 'Wati',
            ],
            [
                'nisn' => '0123456795',
                'nik' => '3171234567890007',
                'nama_depan' => 'Dian',
                'nama_belakang' => 'Pratama',
            ],
            [
                'nisn' => '0123456796',
                'nik' => '3171234567890008',
                'nama_depan' => 'Putri',
                'nama_belakang' => 'Handayani',
            ],
            [
                'nisn' => '0123456797',
                'nik' => '3171234567890009',
                'nama_depan' => 'Andi',
                'nama_belakang' => 'Wijaya',
            ],
            [
                'nisn' => '0123456798',
                'nik' => '3171234567890010',
                'nama_depan' => 'Nina',
                'nama_belakang' => 'Kusuma',
            ],
        ];

        foreach ($students as $student) {
            RawStudent::create($student);
        }
    }
}
