<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Presensi;
use Carbon\Carbon;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ahmad Rizki',
                'nim' => '2021001',
                'status' => 'Hadir',
                'keterangan' => null,
                'tanggal' => Carbon::today(),
                'waktu' => '08:00:00',
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'nim' => '2021002',
                'status' => 'Hadir',
                'keterangan' => null,
                'tanggal' => Carbon::today(),
                'waktu' => '08:05:00',
            ],
            [
                'nama' => 'Budi Santoso',
                'nim' => '2021003',
                'status' => 'Izin',
                'keterangan' => 'Ada acara keluarga',
                'tanggal' => Carbon::today(),
                'waktu' => '08:00:00',
            ],
            [
                'nama' => 'Dewi Lestari',
                'nim' => '2021004',
                'status' => 'Sakit',
                'keterangan' => 'Demam dan flu',
                'tanggal' => Carbon::today(),
                'waktu' => '08:00:00',
            ],
            [
                'nama' => 'Eko Prasetyo',
                'nim' => '2021005',
                'status' => 'Alpha',
                'keterangan' => null,
                'tanggal' => Carbon::today(),
                'waktu' => '08:00:00',
            ],
            [
                'nama' => 'Fatimah Zahra',
                'nim' => null,
                'status' => 'Hadir',
                'keterangan' => 'Tamu',
                'tanggal' => Carbon::yesterday(),
                'waktu' => '09:15:00',
            ],
        ];

        foreach ($data as $item) {
            Presensi::create($item);
        }
    }
}
