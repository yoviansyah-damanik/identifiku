<?php

namespace Database\Seeders;

use App\Models\SchoolStatus;
use Illuminate\Database\Seeder;

class SchoolStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolStatuses = ['Negeri', 'Swasta', 'Lainnya'];

        foreach ($schoolStatuses as $schoolStatus)
            SchoolStatus::create(['name' => $schoolStatus, 'description' => '-']);
    }
}
