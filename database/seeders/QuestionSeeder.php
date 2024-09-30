<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Enums\QuestionTypes;
use App\Models\AnswerChoice;
use App\Models\QuestionType;
use App\Models\QuestionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionTypes = [
            [
                'name' => 'Kognitif',
                'description' => 'Kemampuan intelektual yang berkaitan dengan aktivitas mental, seperti menghubungkan, menilai, dan mempertimbangkan peristiwa.',
                'groups' => [
                    [
                        'name' => 'Kemampuan Literasi',
                        'description' => '-',
                        'questions' => [
                            [
                                'text' => 'Lawannya \'Hemat\' ialah....',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Murah'
                                    ],
                                    [
                                        'text' => 'Kikir'
                                    ],
                                    [
                                        'text' => 'Boros',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Bernilai'
                                    ],
                                    [
                                        'text' => 'Kaya'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Seorang paman ........ lebih tua dari kemenakannya.',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Jarang'
                                    ],
                                    [
                                        'text' => 'Biasanya'
                                    ],
                                    [
                                        'text' => 'Selalu',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak Pernah'
                                    ],
                                    [
                                        'text' => 'Kadang-kadang'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Hari setelah hari minggu adalah...',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Rabu'
                                    ],
                                    [
                                        'text' => 'Senin',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Kamis',
                                    ],
                                    [
                                        'text' => 'Sabtu'
                                    ],
                                    [
                                        'text' => 'Selasa'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Populasi bekantan menurun karena perburuan liar dan kerusakan hutan.',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Benar',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Salah'
                                    ],
                                ]
                            ]
                        ]
                    ],
                    [
                        'name' => 'Kemampuan Numerisasi',
                        'description' => '-',
                        'questions' => [
                            [
                                'text' => 'Lawannya \'Hemat\' ialah....',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Murah'
                                    ],
                                    [
                                        'text' => 'Kikir'
                                    ],
                                    [
                                        'text' => 'Boros',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Bernilai'
                                    ],
                                    [
                                        'text' => 'Kaya'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Seorang paman ........ lebih tua dari kemenakannya.',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Jarang'
                                    ],
                                    [
                                        'text' => 'Biasanya'
                                    ],
                                    [
                                        'text' => 'Selalu',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak Pernah'
                                    ],
                                    [
                                        'text' => 'Kadang-kadang'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Hari setelah hari minggu adalah...',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Rabu'
                                    ],
                                    [
                                        'text' => 'Senin',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Kamis',
                                    ],
                                    [
                                        'text' => 'Sabtu'
                                    ],
                                    [
                                        'text' => 'Selasa'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Populasi bekantan menurun karena perburuan liar dan kerusakan hutan.',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Benar',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Salah'
                                    ],
                                ]
                            ]
                        ]
                    ],
                    [
                        'name' => 'Kemampuan Spasial',
                        'description' => '-',
                        'questions' => [
                            [
                                'text' => 'Lawannya \'Hemat\' ialah....',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Murah'
                                    ],
                                    [
                                        'text' => 'Kikir'
                                    ],
                                    [
                                        'text' => 'Boros',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Bernilai'
                                    ],
                                    [
                                        'text' => 'Kaya'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Seorang paman ........ lebih tua dari kemenakannya.',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Jarang'
                                    ],
                                    [
                                        'text' => 'Biasanya'
                                    ],
                                    [
                                        'text' => 'Selalu',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak Pernah'
                                    ],
                                    [
                                        'text' => 'Kadang-kadang'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Hari setelah hari minggu adalah...',
                                'type' => QuestionTypes::MultipleChoice->name,
                                'answers' => [
                                    [
                                        'text' => 'Rabu'
                                    ],
                                    [
                                        'text' => 'Senin',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Kamis',
                                    ],
                                    [
                                        'text' => 'Sabtu'
                                    ],
                                    [
                                        'text' => 'Selasa'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Populasi bekantan menurun karena perburuan liar dan kerusakan hutan.',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Benar',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Salah'
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Nonkognitif',
                'description' => 'Kemampuan yang berkaitan dengan sosial dan emosional. Kemampuan nonkognitif juga dikenal sebagai soft-skill, yang meliputi motivasi berprestasi, keterampilan interpersonal, dan efikasi diri.',
                'groups' => [
                    [
                        'name' => 'Lingkungan Pergaulan/Aktivitas Peserta Didik di Luar Sekolah dan Luar Rumah',
                        'description' => '-',
                        'questions' => [
                            [
                                'text' => 'Belajar bersama Ayah',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Ya',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Belajar bersama Ibu',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Ya',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Kegiatan di rumah sering bermain',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Ya',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak'
                                    ],
                                ]
                            ],
                        ]
                    ],
                    [
                        'name' => 'Gaya Belajar',
                        'description' => '-',
                        'questions' => [
                            [
                                'text' => 'Suka menjiplak',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Ya',
                                    ],
                                    [
                                        'text' => 'Tidak',
                                        'is_correct' => true
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Saya mudah mengingat sesuatu jika saya melihat',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Ya',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak'
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Suka mencatat disertai gambar',
                                'type' => QuestionTypes::Dichotomous->name,
                                'answers' => [
                                    [
                                        'text' => 'Ya',
                                        'is_correct' => true
                                    ],
                                    [
                                        'text' => 'Tidak'
                                    ],
                                ]
                            ],
                        ]
                    ],
                ]
            ],

        ];

        foreach ($questionTypes as $type) {
            $newType = QuestionType::create(collect($type)->only('name', 'description')->toArray());

            foreach ($type['groups'] as $group) {
                $newGroup =  QuestionGroup::create(['question_type_id' => $newType->id, ...collect($group)->only('name', 'description')->toArray()]);

                foreach ($group['questions'] as $question) {
                    $newQuestion =  Question::create(['question_group_id' => $newGroup->id, ...collect($question)->only('text', 'type')->toArray()]);

                    foreach ($question['answers'] as $answer) {
                        AnswerChoice::create(['question_id' => $newQuestion->id, ...$answer]);
                    }
                }
            }
        }
    }
}
