<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $statuses = ['Hadir', 'Izin', 'Sakit', 'Alpha'];
        
        // Generate presensi for last 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            foreach ($users as $user) {
                // Not everyone present every day
                if (rand(1, 10) <= 8) { // 80% chance of having presensi
                    $status = $statuses[array_rand($statuses)];
                    
                    // Adjust probability - more likely to be present
                    if (rand(1, 10) <= 7) {
                        $status = 'Hadir';
                    }
                    
                    $keterangan = null;
                    if ($status == 'Izin') {
                        $keterangan = 'Ada keperluan keluarga';
                    } elseif ($status == 'Sakit') {
                        $keterangan = 'Demam dan flu';
                    } elseif ($status == 'Alpha') {
                        $keterangan = null;
                    }
                    
                    Presensi::create([
                        'user_id' => $user->id,
                        'nama' => $user->name,
                        'nim' => '202' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                        'status' => $status,
                        'keterangan' => $keterangan,
                        'tanggal' => $date->format('Y-m-d'),
                        'waktu' => $date->format('H:i'),
                    ]);
                }
            }
        }
    }
}
