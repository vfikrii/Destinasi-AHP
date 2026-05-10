<?php

namespace Database\Seeders;

use App\Models\Ir;
use App\Models\User;
use App\Models\SkalaAhp;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin & Guest
        User::create([
            'username' => 'admin',
            'password' => md5('admin123'),
            'role' => 'admin'
        ]);
        User::create([
            'username' => 'guest',
            'password' => md5('guest123'),
            'role' => 'guest'
        ]);

        // Skala AHP
        $skala = [
            ['nama_skala' => 'Sangat Buruk', 'bintang' => 1, 'nilai_ahp' => 1],
            ['nama_skala' => 'Buruk', 'bintang' => 2, 'nilai_ahp' => 3],
            ['nama_skala' => 'Cukup', 'bintang' => 3, 'nilai_ahp' => 5],
            ['nama_skala' => 'Baik', 'bintang' => 4, 'nilai_ahp' => 7],
            ['nama_skala' => 'Sangat Baik', 'bintang' => 5, 'nilai_ahp' => 9],
        ];
        foreach ($skala as $s) {
            SkalaAhp::create($s);
        }

        // Nilai IR (Index Random)
        $irValues = [
            1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90, 5 => 1.12,
            6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49,
            11 => 1.51, 12 => 1.48, 13 => 1.56, 14 => 1.57, 15 => 1.59
        ];

        foreach ($irValues as $n => $nilai) {
            Ir::create(['jumlah' => $n, 'nilai' => $nilai]);
        }
    }
}
