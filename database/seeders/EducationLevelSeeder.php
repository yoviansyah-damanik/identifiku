<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use App\Models\GradesLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educationLevels = [
            [
                'name' => 'TK',
                'description' => '-',
                'grades' => [
                    [
                        'name' => 'TK A',
                        'description' => '-'
                    ],
                    [
                        'name' => 'TK B',
                        'description' => '-'
                    ]
                ]
            ],
            [
                'name' => 'SD/MI Sederajat',
                'description' => '-',
                'grades' => [
                    [
                        'name' => 'Kelas 1',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 2',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 3',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 4',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 5',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 6',
                        'description' => '-'
                    ],
                ]
            ],
            [
                'name' => 'SMP/MTs Sederajat',
                'description' => '-',
                'grades' => [
                    [
                        'name' => 'Kelas 1 (VII)',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 2 (VIII)',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 3 (IX)',
                        'description' => '-'
                    ],
                ]
            ],
            [
                'name' => 'SMA/MA/SMK Sederajat',
                'description' => '-',
                'grades' => [
                    [
                        'name' => 'Kelas 1 (X)',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 2 (XI)',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Kelas 3 (XII)',
                        'description' => '-'
                    ],
                ]
            ],
            [
                'name' => 'Perguruan Tinggi',
                'description' => '-',
                'grades' => [
                    [
                        'name' => 'Semua Jurusan',
                        'description' => '-'
                    ],
                ]
            ],
            [
                'name' => 'Lainnya',
                'description' => '-',
                'grades' => [
                    [
                        'name' => 'Pencari Kerja',
                        'description' => '-'
                    ],
                    [
                        'name' => 'Profesional',
                        'description' => '-'
                    ],
                ]
            ],
        ];

        foreach ($educationLevels as $educationLevel) {
            $createEducationLevel = EducationLevel::create(['name' => $educationLevel['name'], 'description' => $educationLevel['description']]);
            if (isset($educationLevel['grades']))
                $createEducationLevel->grades()->createMany($educationLevel['grades']);
        }
    }
}
