<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'attribute' => 'active_class_limit',
            'value' => 5,
            'description' => 'Jumlah kelas yang dapat ditambahkan oleh Pengajar.'
        ]);

        Configuration::create([
            'attribute' => 'modal_outside_click',
            'value' => false,
            'description' => 'Isi true/false. Fungsi keluar ketika mengklik di luar modal.'
        ]);
    }
}
