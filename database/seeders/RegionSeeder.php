<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(public_path('region.json'));
        $regions = collect(json_decode($json, true))->map(fn($item) => [
            'code' => $item['id'],
            'name' => $item['name'],
            'created_at' => now(),
            'updated_at' => now()
        ])
            ->chunk(300);

        foreach ($regions as $region) {
            // Region::create(['code' => $region['id'], 'name' => $region['name']]);
            Region::insert($region->toArray());
        }
    }
}
