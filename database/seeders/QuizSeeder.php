<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizPhase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Quiz Type
        // studentLearningStyle
        // personalityType
        // keirseyTemperamentSorter
        // multipleIntelligenceType

        // Assessment Rule Type
        // summation
        // calculation
        // group-calculation
        // summative
        // calculation-2

        // Question Type
        // multipleChoice
        // dichotomous

        // [
        //     'name' => '',
        //     'estimation_time' => 60,
        //     'content_coverage' => 'Simulasi kuis IdentifiKu',
        //     'assessment_objectives' => 'Simulasi kuis IdentifiKu',
        //     'overview' => 'Simulasi kuis IdentifiKu',
        //     'user_id' =>  User::role('Superadmin')->first()->id,
        // 'quiz_category_id' => QuizCategory::inRandomOrder()->first()->id,
        // 'quiz_phase_id' => QuizPhase::inRandomOrder()->first()->id,
        //     'is_active' => 1,
        //     'type' => '',
        //     'status' => 1,
        //     'groups' => [
        // [
        //           'name' => 'Kelompok I',
        // 'description' => 'Selesaikan soal sesuai petunjuk',
        //         'questions' => [
        // [
        //             'question' => '',
        //             'operator' => '',
        //             'score' => '',
        //             'answers' => [
        //                 'answer',
        //                 'text',
        //                 'score',
        //             ]
        // ]
        //         ]
        //     ],
        // ],
        //     'rule' => [
        //         'type' => '',
        //         'question_type' => '',
        //         'max_indicator' => '',
        //         'max_answer' => '',
        //         'answers' => [
        //             [
        //                 'answer' => '',
        //                 'score' => '',
        //                 'default' => '',
        //             ]
        //         ],
        //         'indicators' => [[
        //             'answer' => '',
        //             'title' => '',
        //             'indicator' => '',
        //             'recommendation' => '',
        //             'value_min' => '',
        //             'value_max' => '',
        //         ]],
        //     ]
        // ]


        $quizzes = [
            [
                'name' => 'Kuesioner Gaya Belajar Siswa',
                'estimation_time' => 60,
                'content_coverage' => 'Simulasi kuis IdentifiKu',
                'assessment_objectives' => 'Simulasi kuis IdentifiKu',
                'overview' => 'Simulasi kuis IdentifiKu',
                'user_id' => User::role('Superadmin')->first()->id,
                'quiz_category_id' => QuizCategory::inRandomOrder()->first()->id,
                'quiz_phase_id' => QuizPhase::inRandomOrder()->first()->id,
                'is_active' => 1,
                'type' => 'studentLearningStyle',
                'status' => 1,
                'groups' => [
                    [
                        'name' => 'Kelompok I',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya sangat suka...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Mencatat'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Bercerita'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Menjiplak'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saya suka membaca dengan...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Cepat'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Suara keras'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Jari sebagai penunjuk'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saya paling suka belajar dengan...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Membaca'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Mendengarkan'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Bergerak'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saya mudah mengingat dengan apa yang...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Saya lihat'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Saya dengar'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Saya tulis'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Apabila mencatat, saya...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Banyak catatan disertai gambar'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Sedikit mencatat karena lebih suka mendengarkan'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Banyak catatan namun tidak disertai gambar'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saya menjawab pertanyaan dengan jawaban...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Ya atau tidak'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Panjang lebar (suka bercerita)'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Diikuti dengan gerkan anggota tubuh'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saat belajar saya...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Tidak mudah terganggu dengan keributan'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Mudah terganggu dengan keributan'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Tidak dapat duduk diam dalam waktu lama'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saya mengingat dengan cara...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Membayangkan'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Mengucapkan'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Sambal berjalan dan melihat'
                                    ]
                                ]
                            ],
                            [
                                'question' => 'Saya berbicara lebih suka...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Melihat wajah langsung'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Lewat telepon'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Memperhatikan Gerakan tubuh'
                                    ]
                                ]
                            ],
                            [
                                'question' => ' Ketika berbicara saya...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Cepat'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Intonasi/berirama'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Lambat'
                                    ]
                                ]
                            ],
                            [
                                'question' => ' Cara saya belajar bisanya suka...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Mengikuti petunjuk gambar'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Sambal berbicara'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Berbicara sambal menulis'
                                    ]
                                ]
                            ],
                            [
                                'question' => ' Saya sering mengisi waktu luang dengan...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Menonton'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Mendengarkan music'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Bermain game'
                                    ]
                                ]
                            ],
                            [
                                'question' => ' Saya lebih mudah memahami pelajaran dengan...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Melihat peraga'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Berdiskusi'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Praktik'
                                    ]
                                ]
                            ],
                            [
                                'question' => ' saya lebih menyukai...',
                                'answers' =>
                                [
                                    [
                                        'answer' => 'A',
                                        'text' => 'Gambar'
                                    ],
                                    [
                                        'answer' => 'B',
                                        'text' => 'Musik'
                                    ],
                                    [
                                        'answer' => 'C',
                                        'text' => 'Permainan'
                                    ]
                                ]
                            ],
                        ]
                    ]
                ],
                'rule' => [
                    'type' => 'summation',
                    'question_type' => 'multipleChoice',
                    'max_indicator' => '3',
                    'max_answer' => '3',
                    'answers' => [
                        [
                            'answer' => 'A',
                        ],
                        [
                            'answer' => 'B',
                        ],
                        [
                            'answer' => 'C',
                        ],
                    ],
                    'indicators' => [
                        [
                            'answer' => 'A',
                            'title' => 'Gaya Belajar Visual',
                            'indicator' => '<ol>
                                <li>Cara belajar dengan membaca</li>
                                <li>Suka mencatat</li>
                                <li>Membaca dengan cepat dan tekun</li>
                                <li>Mudah mengingat apa yang dilihat daripada yang didengar</li>
                                <li>Tidak terganggu dengan keributan</li>
                                <li>Sering menjawab pertanyaan dengan ya/tidak</li>
                                <li>Pola berbicara cepat</li>
                                <li>Cara bekerja mengikuti petunjuk gambar dan perencana jangka Panjang yang baik</li>
                                <li>Cara berkomunikasi langsung/melihat ekspresi wajah</li>
                                <li>Kegiatan yang disukai adalah demonstrasi</li>
                                <li>Lebih suka seni daripada musik</li>
                            </ol>',
                            'recommendation' => '<b>Kecerdasan Verbal atau Linguistik</b><br/><p>Gunakan teks visual, seperti catatan bergambar atau buku bergambar, untuk membantu siswa memahami informasi dalam bentuk kata-kata yang disertai ilustrasi.	Gunakan metode tanya jawab lisan, diskusi kelompok, dan membaca keras teks untuk memperdalam pemahaman.	Ajak siswa untuk menulis catatan atau mengekspresikan ide melalui tulisan sambil bergerak, seperti menulis di papan tulis atau mencatat sambil berdiskusi.</p><br/<br/><b>Kecerdasan Logis atau Matematis</b><br/><p>Gunakan diagram alur, grafik, dan tabel untuk menjelaskan konsep-konsep abstrak dalam matematika atau logika.	Gunakan penjelasan verbal yang mendalam dan diskusi mengenai konsep-konsep matematis atau logis secara verbal.	Ajak siswa untuk memecahkan masalah matematis melalui kegiatan praktis seperti eksperimen atau permainan matematika yang melibatkan gerakan fisik.</p><br/<br/><b>Kecerdasan Visual atau Spasial</b><br/><p>Tampilkan model 3D atau peta untuk menjelaskan konsep-konsep ruang dan bentuk.	Dukungan audio yang menjelaskan peta atau gambar yang sedang dibahas.	Gunakan permainan atau proyek kreatif yang melibatkan perancangan model atau bangunan fisik.</p><br/<br/><b>Kecerdasan Kinestetik</b><br/><p>Kombinasikan media visual dengan kegiatan praktis yang melibatkan pengamatan dan eksperimen langsung.	Diskusikan konsep melalui simulasi berbicara sambil bergerak atau menggunakan alat peraga yang menghasilkan suara.	Ajak siswa untuk berpartisipasi dalam eksperimen, peragaan, atau aktivitas fisik yang sesuai dengan materi pelajaran.</p><br/<br/><b>Kecerdasan Musikal</b><br/><p>Gunakan video musik atau animasi dengan elemen audio untuk memperkuat konsep-konsep yang diajarkan.	Gunakan lagu atau ritme untuk membantu siswa memahami materi yang lebih rumit atau menghafal.	Ciptakan kegiatan yang melibatkan tubuh dan musik, seperti menari sambil belajar.</p><br/<br/><b>Kecerdasan Interpersonal</b><br/><p>Tampilkan visual yang menggambarkan situasi sosial atau dinamika kelompok untuk meningkatkan pemahaman tentang hubungan antarmanusia.	Diskusikan topik-topik sosial dalam bentuk percakapan atau debat kelompok.	Ajak siswa berinteraksi dalam kegiatan kelompok yang melibatkan gerakan, seperti simulasi situasi sosial.</p><br/<br/><b>Kecerdasan Intrapersonal</b><br/><p>Gunakan visual yang mendorong refleksi pribadi dan pemahaman diri.	Ajak siswa untuk berdiskusi dengan diri sendiri melalui rekaman suara dan refleksi pribadi.	Ajak siswa untuk merasakan pengalaman pembelajaran melalui aktivitas fisik yang mendalam, seperti meditasi gerak.</p><br/<br/><b>Kecerdasan Naturalis</b><br/><p>Gunakan gambar alam, peta, atau diagram ekosistem untuk memperjelas konsep-konsep alam.	Gunakan narasi audio untuk menjelaskan hubungan manusia dengan alam.	Gunakan kegiatan luar ruang yang memungkinkan siswa berinteraksi langsung dengan alam.</p><br/<br/><b>Metode Pembelajaran</b><br/><p>Gunakan media visual seperti gambar, infografis, diagram, video pembelajaran, dan slide presentasi.	Fokus pada penggunaan pendengaran, seperti ceramah, diskusi, podcast, dan rekaman audio.	Pembelajaran berbasis pengalaman langsung, eksperimen, dan aktivitas fisik.</p><br/<br/><b>Feedback Interaktif</b><br/><p>Berikan umpan balik berupa video atau infografis yang menunjukkan kemajuan dan saran perbaikan dalam visual yang menarik.	Berikan umpan balik melalui pesan suara atau rekaman yang membimbing siswa untuk meningkatkan pemahaman mereka.	•  erikan umpan balik yang menyarankan aktivitas fisik tertentu untuk memperbaiki atau mengembangkan pemahaman mereka terhadap materi.</p><br/<br/><b>Integrasi Kurikulum Merdeka</b><br/><p>Sesuaikan metode dengan pendekatan berbasis proyek, di mana siswa dapat mengeksplorasi pembelajaran secara visual dan kreatif, memanfaatkan fleksibilitas waktu dan metode dalam Kurikulum Merdeka.	Pendekatan berbasis diskusi dan debat yang dapat berlangsung di luar kelas, mendukung fleksibilitas pembelajaran berbasis suara sesuai dengan karakteristik Kurikulum Merdeka.	Aplikasi pendekatan pembelajaran berbasis pengalaman dan aktivitas, dengan memungkinkan siswa belajar melalui eksplorasi dunia nyata dan praktik langsung, sesuai dengan prinsip fleksibilitas dalam Kurikulum Merdeka.</p>',
                        ],
                        [
                            'answer' => 'B',
                            'title' => 'Gaya Belajar Auditorial',
                            'indicator' => '<ol>
                                <li>Cara belajar dengan mendengarkan</li>
                                <li>Kesulitan dalam menulis/mencatat tetapi pandai bercerita</li>
                                <li>Membaca dengan suara keras</li>
                                <li>Mudah mengingat apa yang didiskusikan/dijelaskan daripada yang dilihat</li>
                                <li>Mudah terganggu dengan keributan</li>
                                <li>Sering menjawab pertanyaan dengan panjang lebar</li>
                                <li>Pola berbicara sedang dan berirama</li>
                                <li>Cara bekerja sambil berbicara dan mampu menirukan perubahan suara</li>
                                <li>Cara berkomunikasi senang lewat telepon</li>
                                <li>Kegiatan yang disukai adalah diskusi/berbicara</li>
                                <li>Lebih suka music daripada seni</li>
                            </ol>',
                            'recommendation' => '<b>Kecerdasan Verbal atau Linguistik</b><br/><p>Gunakan metode tanya jawab lisan, diskusi kelompok, dan membaca keras teks untuk memperdalam pemahaman.</p><br/<br/><b>Kecerdasan Logis atau Matematis</b><br/><p>Gunakan penjelasan verbal yang mendalam dan diskusi mengenai konsep-konsep matematis atau logis secara verbal.</p><br/<br/><b>Kecerdasan Visual atau Spasial</b><br/><p>Dukungan audio yang menjelaskan peta atau gambar yang sedang dibahas.</p><br/<br/><b>Kecerdasan Kinestetik</b><br/><p>Diskusikan konsep melalui simulasi berbicara sambil bergerak atau menggunakan alat peraga yang menghasilkan suara.</p><br/<br/><b>Kecerdasan Musikal</b><br/><p>Gunakan lagu atau ritme untuk membantu siswa memahami materi yang lebih rumit atau menghafal.</p><br/<br/><b>Kecerdasan Interpersonal</b><br/><p>Diskusikan topik-topik sosial dalam bentuk percakapan atau debat kelompok.</p><br/<br/><b>Kecerdasan Intrapersonal</b><br/><p>Ajak siswa untuk berdiskusi dengan diri sendiri melalui rekaman suara dan refleksi pribadi.</p><br/<br/><b>Kecerdasan Naturalis</b><br/><p>Gunakan narasi audio untuk menjelaskan hubungan manusia dengan alam.</p><br/<br/><b>Metode Pembelajaran</b><br/><p>Fokus pada penggunaan pendengaran, seperti ceramah, diskusi, podcast, dan rekaman audio.</p><br/<br/><b>Feedback Interaktif</b><br/><p>Berikan umpan balik melalui pesan suara atau rekaman yang membimbing siswa untuk meningkatkan pemahaman mereka.</p><br/<br/><b>Integrasi Kurikulum Merdeka</b><br/><p>Pendekatan berbasis diskusi dan debat yang dapat berlangsung di luar kelas, mendukung fleksibilitas pembelajaran berbasis suara sesuai dengan karakteristik Kurikulum Merdeka.</p>',
                        ],
                        [
                            'answer' => 'C',
                            'title' => 'Gaya Belajar Kinestetik',
                            'indicator' => '<ol>
                                <li>Cara belajar senang dengan model praktik</li>
                                <li>Banyak sekali tulisan tanpa dibaca kembali</li>
                                <li>Membaca dengan menggunakan jari sebagai penunjuk</li>
                                <li>Mengingat dengan menulis informasi berkali-kali</li>
                                <li>Tidak dapat duduk diam dalam waktu lama</li>
                                <li>Sering menjawab pertanyaan dengan diikuti gerakan tubuh</li>
                            </ol>',
                            'recommendation' => '<b>Kecerdasan Verbal atau Linguistik</b><br/><p>Ajak siswa untuk menulis catatan atau mengekspresikan ide melalui tulisan sambil bergerak, seperti menulis di papan tulis atau mencatat sambil berdiskusi.</p><br/<br/><b>Kecerdasan Logis atau Matematis</b><br/><p>Ajak siswa untuk memecahkan masalah matematis melalui kegiatan praktis seperti eksperimen atau permainan matematika yang melibatkan gerakan fisik.</p><br/<br/><b>Kecerdasan Visual atau Spasial</b><br/><p>Gunakan permainan atau proyek kreatif yang melibatkan perancangan model atau bangunan fisik.</p><br/<br/><b>Kecerdasan Kinestetik</b><br/><p>Ajak siswa untuk berpartisipasi dalam eksperimen, peragaan, atau aktivitas fisik yang sesuai dengan materi pelajaran.</p><br/<br/><b>Kecerdasan Musikal</b><br/><p>Ciptakan kegiatan yang melibatkan tubuh dan musik, seperti menari sambil belajar.</p><br/<br/><b>Kecerdasan Interpersonal</b><br/><p>Ajak siswa berinteraksi dalam kegiatan kelompok yang melibatkan gerakan, seperti simulasi situasi sosial.</p><br/<br/><b>Kecerdasan Intrapersonal</b><br/><p>Ajak siswa untuk merasakan pengalaman pembelajaran melalui aktivitas fisik yang mendalam, seperti meditasi gerak.</p><br/<br/><b>Kecerdasan Naturalis</b><br/><p>Gunakan kegiatan luar ruang yang memungkinkan siswa berinteraksi langsung dengan alam.</p><br/<br/><b>Metode Pembelajaran</b><br/><p>Pembelajaran berbasis pengalaman langsung, eksperimen, dan aktivitas fisik.</p><br/<br/><b>Feedback Interaktif</b><br/><p>Berikan umpan balik yang menyarankan aktivitas fisik tertentu untuk memperbaiki atau mengembangkan pemahaman mereka terhadap materi.</p><br/<br/><b>Integrasi Kurikulum Merdeka</b><br/><p>Aplikasi pendekatan pembelajaran berbasis pengalaman dan aktivitas, dengan memungkinkan siswa belajar melalui eksplorasi dunia nyata dan praktik langsung, sesuai dengan prinsip fleksibilitas dalam Kurikulum Merdeka.</p>',
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Angket Tipe Kepribadian',
                'estimation_time' => 60,
                'content_coverage' => 'Simulasi kuis IdentifiKu',
                'assessment_objectives' => 'Simulasi kuis IdentifiKu',
                'overview' => 'Simulasi kuis IdentifiKu',
                'user_id' =>  User::role('Superadmin')->first()->id,
                'quiz_category_id' => QuizCategory::inRandomOrder()->first()->id,
                'quiz_phase_id' => QuizPhase::inRandomOrder()->first()->id,
                'is_active' => 1,
                'type' => 'personalityType',
                'status' => 1,
                'groups' => [
                    [
                        'name' => 'Kelompok I',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya tidak suka dengan tempat yang ramai',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya cepat dalam mengerjakan soal matematika',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya menyukai suasana yang tenang',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya lebih suka rebahan daripada mengikuti kegiatan',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya berani mengutarakan pendapat saya saat berdiskusi',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya berani maju ke depan untuk mengerjakan soal di papan tulis',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya takut melakukan kegiatan yang mengambil risiko tinggi',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya cenderung melakukan kegiatan yang teratur setiap harinya',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya tidak pernah bolos saat jam pelajaran',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Dalam mengerjakan soal jika saya tidak bisa, saya akan mencontek',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya menyukai aktivitas yang memerlukan konsentrasi',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya konsisten dalam belajar di kelas',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya fokus dalam mengerjakan soal matematika',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya menyukai pelajaran matematika',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya sering menunda-nunda dalam mengerjakan PR matematika',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya sering mengabaikan janji yang telah dibuat',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya tidak pernah mengerjakan pekerjaan rumah (PR)',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya selalu belajar sebelum pelajaran dimulai',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya selalu menyelesaikan tugas saya tepat waktu',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya bertanggung jawab terhadap tugas matematika',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya suka terlibat dalam kegiatan sosial seperti gotong royong, organisasi, dll',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya merasa nyaman saat berada di keramaian',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya suka belajar berkelompok daripada sendirian',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya cenderung tidak nyaman saat berada di tengah banyak orang',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya suka bekerja sendirian daripada berkelompok',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya tipe orang yang mudah marah',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Jika dalam mengerjakan tugas saya tidak bisa, saya akan putus asa',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya mudah menyatakan perasaan saya kepada orang lain',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Jika dalam mengerjakan tugas saya tidak bisa, saya akan meminta bantuan teman',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya terburu-buru dalam melakukan pekerjaan',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Jika ada teman yang mengajak saya bermain, saya akan langsung ikut walaupun saya memiliki banyak tugas yang harus dikerjakan',
                                'operator' => '-',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Saya selalu berhati-hati dalam berbicara',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                            [
                                'question' => 'Dalam menjawab soal saya cenderung mengerjakan dengan hati-hati',
                                'operator' => '+',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 4,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 3,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ]
                            ],
                        ]
                    ]
                ],
                'rule' => [
                    'type' => 'calculation-2',
                    'question_type' => 'multipleChoice',
                    'max_indicator' => '2',
                    'max_answer' => '4',
                    'answers' => [
                        [
                            'answer' => 'A',
                            'score' => 4,
                            'default' => 'Sangat Setuju',
                        ],
                        [
                            'answer' => 'B',
                            'score' => 3,
                            'default' => 'Setuju',
                        ],
                        [
                            'answer' => 'C',
                            'score' => 2,
                            'default' => 'Tidak Setuju',
                        ],
                        [
                            'answer' => 'D',
                            'score' => 1,
                            'default' => 'Sangat Tidak Setuju',
                        ],
                    ],
                    'indicators' => [
                        [
                            'answer' => 1,
                            'title' => 'Extrovert',
                            'indicator' => '<ol><li>Menikmati suasana sosial</li><li>Suka mencari perhatian</li><li>Memiliki energi saat berada bersama orang lain</li><li>Berteman dengan banyak orang</li><li>Ramah</li><li>Senang keluar</li><li>Menikmati kerja kelompok</li><li>Lebih suka berbicara daripada menulis</li></ol>',
                            'recommendation' => '<b>Rekomendasi Pembelajaran</b><br/><p>Preferensikan pembelajaran berbasis diskusi kelompok, proyek kolaboratif, atau kegiatan sosial di luar kelas.</p>',
                            'value_min' => '18',
                            'value_max' => '100',
                        ],
                        [
                            'answer' => 2,
                            'title' => 'Introvert',
                            'indicator' => '<ol><li>Mereka merasa lelah saat harus berhadapan dengan banyak orang</li><li>Introvert lebih suka menghabiskan waktunya sendirian</li><li>Memiliki teman yang sedikit</li><li>Mereka suka bicara sendiri</li><li>Mereka selalu berpikir sebelum bertindak</li><li>Lebih produktif saat harus bekerja sendirian</li><li>Mereka lebih suka mengeluarkan pikirannya dalam bentuk tulisan</li><li>Suka berimajinasi</li></ol>',
                            'recommendation' => '<b>Rekomendasi Pembelajaran</b><br/><p>Fokuskan pada pembelajaran mandiri, proyek individu, dan materi yang memungkinkan siswa merenung dan bekerja sendiri.</p>',
                            'value_min' => '0',
                            'value_max' => '17',
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Kecerdasan Majemuk',
                'estimation_time' => 60,
                'content_coverage' => 'Simulasi kuis IdentifiKu',
                'assessment_objectives' => 'Simulasi kuis IdentifiKu',
                'overview' => 'Simulasi kuis IdentifiKu',
                'user_id' =>  User::role('Superadmin')->first()->id,
                'quiz_category_id' => QuizCategory::inRandomOrder()->first()->id,
                'quiz_phase_id' => QuizPhase::inRandomOrder()->first()->id,
                'is_active' => 1,
                'type' => 'multipleIntelligenceType',
                'status' => 1,
                'groups' => [
                    [
                        'name' => 'Kecerdasan Verbal atau Linguistik',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya seorang pembicara yang baik.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang bercerita, termasuk cerita dongeng dan cerita yang lucu.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya memiliki ingatan yang baik untuk hal-hal yang sepele.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi (berpendapat) saya cenderug menggunakan kata-kata sindiran.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika sesuatu rusak dan tidak berfungsi saya akan membaca panduannya terlebih dahulu.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya membaca buku hanya sebagai hobi.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang membicarakan dan menulis ide-ide saya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok untuk menyiapkan sebuah presentasi, saya lebih memilih untuk menulis dan melakukan riset pustaka.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya menciptakan irama atau kata-kata yang membantu saya untuk mengingatnya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka permainan kata-kata, seperti scrabble atau puzzle.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Logis atau Matematis',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Dapat memecahkan soal-soal hitungan adalah hal yang menyenangkan bagi saya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya sangat menikmati pelajaran matematika.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya menyukai komputer dan permainan angka-angka.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi, saya mencoba mencari solusi yang adil dan logis.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya cenderung menempatkan setiap kejadian dalam urutan yang logis.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka bermain catur, checkers, atau monopoli.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang mencari tahu bagaimana cara kerja setiap benda.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok, saya lebih memilih membuat diagram dan grafik.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya menyukai permainan logika.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika ada sesuatu yang rusak dan tidak berfungsi, saya akan melihat bagian-bagiannya dan mencari tahu bagaimana cara kerjanya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Visual atau Spasial',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya senang menggambar atau menciptakan sesuatu.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya menikmati hobi saya dalam bidang fotografi.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu yang rumit, saya menggambar diagram untuk membantu mengingatnya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya sering melamun.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya lebih memilih peta daripada petunjuk tertulis dalam mencari sebuah alamat.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok, saya lebih memilih menggambar hal-hal yang penting.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi, biasaya saya menjaga jarak atau tetap berdiam diri.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang membuat coret-coretan di atas kertas.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saat membaca majalah, saya lebih suka melihat gambarnya daripada membaca artikelnya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika sesuatu rusak dan tidak berfungsi, saya cenderung memplejari diagram mengenai cara kerjanya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Kinestetik',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya senang mengetuk-ngetukkan jari atau memainkan pulpen atau pensil selama jam pelajaran.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok saya lebih memilih memindahkan barang atau membuat suatu bentuk.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Ketika melihat benda-benda yang menarik hati, saya senang menyentuhnya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya menyukai kegiatan seperti pertukangan, menjahit, dan membuat bentuk-bentuk.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka berolahraga, saya juga suka senam.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya tidak bisa duduk diam dalam waktu yang lama.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya menuliskannya berkali-kali sampai saya memahaminya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saat berdiskusi saya cenderung menyerang atau malah menghindari perdebatan.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya menggunakan banyak gerakan tubuh ketika berbicara.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika sesuatu rusak dan tidak berfungsi, saya cenderung memisahkan setiap bagian lalu menggabungkannya kembali.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Musikal',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya suka bernyanyi.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya bisa menghafal nada-nada dari banyak lagu.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka mendengarkan musik sambil belajar atau sambil membaca buku.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya bisa memainkan salah satu alat musik dengan baik.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya cenderung bersenandung ketika sedang bekerja.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang mendengarkan musik dan radio.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya mencoba untuk membuat irama tentang hal tersebut.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi, saya cenderung berteriak atau memukul (meja/benda) atau bergerak dalam satu irama.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok, saya lebih suka menggunakan kata-kata baru dari nada atau musik yang sudah dikenal.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika ada masalah, saya cenderung mengetuk-ngetuk jari saya membentuk suatu irama sambil mencari jalan keluar.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Interpersonal',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya senang berkumpul atau berorganisasi',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Teman-teman serig meminta saran dari saya karena saya dianggap pemimpin mereka',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi, saya cenderung meminta bantuan teman atau pihak-pihak yang ahli dalam bidang tersebut',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka membantu mengajar murid-murid lain',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya mempunyai banyak teman akrab',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang bekerja sama dalam kelompok',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya mampu bergaul baik dengan orang lain',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok, saya lebih memilih mengatur tugas dalam kelompok',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya meminta seseorang untuk menguji saya apakah saya sudah memahaminya',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika sesuatu rusak dan tidak berfungsi, saya mencari seseorang yang dapat menolong saya membetulkannya',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Intrapersonal',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya tidak suka keramaian.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya memahami kelebihan dan kekurangan diri saya.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka menulis buku harian.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya menyukai diri saya sendiri.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya suka bekerja sendirian tanpa ada gangguan orang lain.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya cenderung menutup mata saya dan mencoba merasakan pengalaman itu kembali.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok, saya senang mengontribusikan sesuatu yang unik berdasarkan apa yang saya miliki dan rasakan.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi saya biasanya menghindar atau keluar ruangan hingga saya dapat menenangkan diri.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya memiliki tekad yang kuat, mandiri, dan berpendirian kuat. Saya tidak mudah ikut-ikutan orang lain.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika sesuatu rusak dan tidak berfungsi, saya mempertimbangkan apakah benda tersebut masih layak untuk diperbaiki.',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                    [
                        'name' => 'Kecerdasan Naturalis',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya senang berkebun',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang mengoleksi perangko, koin, dan barang semacamnya',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Ketika dewasa, saya ingin pergi dari kota yang ramai ke tempat yang masih alami untuk menikmati alam',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya sangat memerhatikan sekeliling dan apa yang sedang terjadi di sekitar saya',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang berjalan-jalan ke hutan atau taman untuk melihat-lihat pohon atau bunga',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Saya senang mempelajari nama dan jenis makhluk hidup atau tanaman di sekitar lingkungan saya',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika saya harus mengingat sesuatu, saya cenderung mengategorikannya dalam kelompok-kelompok',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam kerja kelompok, saya lebih memilih mengatur dan mengelompokkan informasi dalam kategori-kategori sehingga mudah dimengerti',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Dalam berargumentasi, saya cenderung membandingkan lawan saya dengan seseorang atau sesuatu yang pernah saya baca atau dengar lalu bereaksi',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                            [
                                'question' => 'Jika sesuatu rusak dan tidak berfungsi, saya memerhatikan sekeliling saya untuk melihat apa yang bisa saya temukan untuk memperbaikinya',
                                'answers' => [
                                    [
                                        'answer' => 'A',
                                        'score' => 5,
                                        'text' => 'Sangat Setuju',
                                    ],
                                    [
                                        'answer' => 'B',
                                        'score' => 4,
                                        'text' => 'Setuju',
                                    ],
                                    [
                                        'answer' => 'C',
                                        'score' => 3,
                                        'text' => 'Agak setuju',
                                    ],
                                    [
                                        'answer' => 'D',
                                        'score' => 2,
                                        'text' => 'Tidak Setuju',
                                    ],
                                    [
                                        'answer' => 'E',
                                        'score' => 1,
                                        'text' => 'Sangat Tidak Setuju',
                                    ],
                                ],
                            ],
                        ]
                    ],
                ],
                'rule' => [
                    'type' => 'group-calculation',
                    'question_type' => 'multipleChoice',
                    'max_indicator' => 0,
                    'max_answer' => 5,
                    'answers' => [
                        [
                            'answer' => 'A',
                            'score' => 5,
                            'default' => 'Sangat Setuju',
                        ],
                        [
                            'answer' => 'B',
                            'score' => 4,
                            'default' => 'Setuju',
                        ],
                        [
                            'answer' => 'C',
                            'score' => 3,
                            'default' => 'Agak setuju',
                        ],
                        [
                            'answer' => 'D',
                            'score' => 2,
                            'default' => 'Tidak Setuju',
                        ],
                        [
                            'answer' => 'E',
                            'score' => 1,
                            'default' => 'Sangat Tidak Setuju',
                        ],
                    ],
                ]
            ],
            [
                'name' => 'Instrumen Angket Penggolongan Tipe Kepribadian',
                'estimation_time' => 60,
                'content_coverage' => 'Simulasi kuis IdentifiKu',
                'assessment_objectives' => 'Simulasi kuis IdentifiKu',
                'overview' => 'Simulasi kuis IdentifiKu',
                'user_id' =>  User::role('Superadmin')->first()->id,
                'quiz_category_id' => QuizCategory::inRandomOrder()->first()->id,
                'quiz_phase_id' => QuizPhase::inRandomOrder()->first()->id,
                'is_active' => 1,
                'type' => 'keirseyTemperamentSorter',
                'status' => 1,
                'groups' => [
                    [
                        'name' => 'Kelompok I',
                        'description' => 'Selesaikan soal sesuai petunjuk',
                        'questions' => [
                            [
                                'question' => 'Saya lebih suka belajar:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Seni dan kerajinan'],
                                    ['answer' => 'B', 'text' => 'Bahasa dan sastra'],
                                    ['answer' => 'C', 'text' => 'Bisnis dan keuangan'],
                                    ['answer' => 'D', 'text' => 'Sains dan Teknik'],
                                ]
                            ],
                            [
                                'question' => 'Saya merasa diri saya paling baik ketika:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Saya berperilaku Anggun'],
                                    ['answer' => 'B', 'text' => 'Saya menjalin hubungan dengan seseorang'],
                                    ['answer' => 'C', 'text' => 'Saya sangat bisa diandalkan'],
                                    ['answer' => 'D', 'text' => 'Saya melatih kecerdikan saya'],
                                ]
                            ],
                            [
                                'question' => 'Ketika suasana hati baik, saya lebih sering:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Bersemangat dan terstimulasi'],
                                    ['answer' => 'B', 'text' => 'Antusias & terinspirasi'],
                                    ['answer' => 'C', 'text' => 'Berhati-hati dan bijaksana'],
                                    ['answer' => 'D', 'text' => 'Diam dan menyendiri'],
                                ]
                            ],
                            [
                                'question' => 'Saya konsisten dalam:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Menyempurnakan keahlian saya'],
                                    ['answer' => 'B', 'text' => 'Membantu orang lain agar percaya diri'],
                                    ['answer' => 'C', 'text' => 'Membantu orang lain melakukan yang benar'],
                                    ['answer' => 'D', 'text' => 'Mencari tahu bagaimana segala sesuatu bekerja'],
                                ]
                            ],
                            [
                                'question' => 'Saya cenderung untuk menjadi:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Praktis & mencari-cari kesempatan'],
                                    ['answer' => 'B', 'text' => 'Penyayang & suka menolong'],
                                    ['answer' => 'C', 'text' => 'Patuh & rajin'],
                                    ['answer' => 'D', 'text' => 'Efisien & berpikir realistis'],
                                ]
                            ],
                            [
                                'question' => 'Saya lebih menghargai diri saya yang:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Berani & petualang'],
                                    ['answer' => 'B', 'text' => 'Baik hati & berniat baik'],
                                    ['answer' => 'C', 'text' => 'Melakukan perbuatan baik'],
                                    ['answer' => 'D', 'text' => 'Otonom & mandiri'],
                                ]
                            ],
                            [
                                'question' => 'Saya cenderung lebih percaya pada:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Dorongan hati & keinginan'],
                                    ['answer' => 'B', 'text' => 'Kata hati & isyarat'],
                                    ['answer' => 'C', 'text' => 'Adat istiadat & tradisi'],
                                    ['answer' => 'D', 'text' => 'Alasan murni & logika'],
                                ]
                            ],
                            [
                                'question' => 'Saya kadang-kadang ingin:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Membuat kesan & mempunyai pengaruh'],
                                    ['answer' => 'B', 'text' => 'Menenggelamkan diri dalam mimpi romantic'],
                                    ['answer' => 'C', 'text' => 'Diakui sebagai anggota'],
                                    ['answer' => 'D', 'text' => 'Membuat terobosan ilmiah'],
                                ]
                            ],
                            [
                                'question' => 'Sepanjang hidup saya terus mencari:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Sensasi & petualangan'],
                                    ['answer' => 'B', 'text' => 'Pemahaman diri'],
                                    ['answer' => 'C', 'text' => 'Keselamatan dan keamanan'],
                                    ['answer' => 'D', 'text' => 'Langkah-langkah penyelesaian masalah yang efisien'],
                                ]
                            ],
                            [
                                'question' => 'Dalam menghadapi masa depan:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Saya yakin sebuah keberuntungan akan datang'],
                                    ['answer' => 'B', 'text' => 'Saya percaya pada kebaikan orang'],
                                    ['answer' => 'C', 'text' => 'Saya tidak boleh terlalu berhati-hati'],
                                    ['answer' => 'D', 'text' => 'Lebih baik selalu waspada'],
                                ]
                            ],
                            [
                                'question' => 'Jika memungkinkan saya ingin menjadi:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Seorang pemain musik yang artistic'],
                                    ['answer' => 'B', 'text' => 'Seorang pemimpin agama yang bijaksana'],
                                    ['answer' => 'C', 'text' => 'Seorang pejabat tinggi'],
                                    ['answer' => 'D', 'text' => 'Seorang ahli teknologi'],
                                ]
                            ],
                            [
                                'question' => 'Saya akan melakukan yang terbaik dalam pekerjaan yang berhubungan dengan:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Perkakas & peralatan'],
                                    ['answer' => 'B', 'text' => 'Pengembangan sumber daya manusia'],
                                    ['answer' => 'C', 'text' => 'Perlengkapan dan jasa'],
                                    ['answer' => 'D', 'text' => 'Sistem & struktur'],
                                ]
                            ],
                            [
                                'question' => 'Dalam bertindak, saya mempertimbangkan:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Keuntungan langsung'],
                                    ['answer' => 'B', 'text' => 'Kemungkinan-kemungkinan yang akan terjadi'],
                                    ['answer' => 'C', 'text' => 'Pengalaman masa lalu'],
                                    ['answer' => 'D', 'text' => 'Kondisi yang diperlukan'],
                                ]
                            ],
                            [
                                'question' => 'Saya sangat percaya diri ketika saya:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Mudah beradaptasi & menyesuaikan diri'],
                                    ['answer' => 'B', 'text' => 'Menjadi diri sendiri yang sebenarnya'],
                                    ['answer' => 'C', 'text' => 'Dihormati dan dihargai'],
                                    ['answer' => 'D', 'text' => 'Berkemauan keras & teguh'],
                                ]
                            ],
                            [
                                'question' => 'Saya menghargai ketika orang lain:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Mengejutkan saya dengan kemurahan hati mereka'],
                                    ['answer' => 'B', 'text' => 'Mengenali diri saya yang sebenarnya'],
                                    ['answer' => 'C', 'text' => 'Mengungkapkan rasa terima kasih mereka'],
                                    ['answer' => 'D', 'text' => 'Meminta pendapat atau pemikiran saya'],
                                ]
                            ],
                            [
                                'question' => 'Ketika memikirkan tentang kegagalan:',
                                'answers' => [
                                    ['answer' => 'A', 'text' => 'Saya biasanya menertawakannya'],
                                    ['answer' => 'B', 'text' => 'Saya sering bertanya-tanya mengapa itu dapat terjadi'],
                                    ['answer' => 'C', 'text' => 'Saya mencoba untuk membuat yang terbaik dari itu '],
                                    ['answer' => 'D', 'text' => 'Saya melihatnya dari sudut pandang yang luas'],
                                ]
                            ],

                        ]
                    ],
                ],
                'rule' => [
                    'type' => 'calculation',
                    'question_type' => 'multipleChoice',
                    'max_indicator' => '4',
                    'max_answer' => '4',
                    'answers' => [
                        [
                            'answer' => 'A',
                        ],
                        [
                            'answer' => 'B',
                        ],
                        [
                            'answer' => 'C',
                        ],
                        [
                            'answer' => 'D',
                        ]
                    ],
                    'indicators' => [
                        [
                            'answer' => 'A',
                            'title' => 'Artisan',
                            'indicator' => '<p>Artisan ialah salah satu dari empat kepribadian yang didefinisikan oleh Keirsey dan memiliki keterkaitan dengan tipe SP (sensing–perceiving) Myers-Briggs. Berikut variasi peran tipe Artisan yang berkolerasi dengan tipe Myers-Briggs: Komposer (ISFP), Pengrajin (ISTP), Penampil (ESFP), dan Promotor (ESTP). Seorang Artisan bersifat konkret dan mudah beradaptasi. Ia mencari dorongan, keahlian, dan peduli dalam rangka membuat dampak. Kekuatan terbesar mereka adalah taktik. Mereka unggul dalam pemecahan masalah, cekatan, dan mahir memainkan alat, instrumen, maupun peralatan. Dua varian peran dari tipe ini adalah:</p><br/><ol><li>Operator adalah Artisan yang proaktif. Apapun dilakukannya secara cepat. Dua varian perannya ialah Pengrajin yang penuh perhatian (attentive Crafter) dan Promotor yang ekspresif (expressive Promoter).</li><li>Penghibur adalah Artisan yang informatif (reaktif). Mereka senang melakukan improvisasi. Dua varian perannya ialah Komposer yang penuh perhatian (attentive Composer) dan Penampil yang ekspresif (expressive Performer).</li></ol>',
                            'recommendation' => '',
                        ],
                        [
                            'answer' => 'C',
                            'title' => 'Guardian',
                            'indicator' => '<p>Guardian ialah salah satu dari empat kepribadian yang didefinisikan oleh Keirsey dan memiliki keterkaitan dengan tipe SJ (sensing–judging) Myers–Briggs. Berikut variasi peran tipe Guardian yang berkolerasi dengan tipe Myers-Briggs: Inspektur (ISTJ), Pelindung (ISFJ), Pemberi (ESFJ), dan Supervisor (ESTJ). Seorang Guardian bersifat konkret dan terorganisir. Ia mendambakan kedamaian dan rasa memiliki, serta peduli terhadap tanggung jawab juga tugas. Kekuatan terbesar mereka adalah logistik. Mereka unggul dalam mengatur, memfasilitasi, memeriksa, dan mendukung Dua varian peran dari tipe ini adalah:</p><br/><ol><li>Administrator adalah Guardian yang proaktif. Mereka cakap dalam mengatur suatu hal. Dua varian perannya ialah Inspektur yang penuh perhatian (attentive Inspector) dan Supervisor yang ekspresif (expressive Supervisor).</li><li>Konservator adalah Guardian yang informatif (reaktif). Mereka adalah sosok yang memberi dukungan. Dua varian perannya ialah Pelindung yang penuh perhatian (attentive Protector) dan Pemberi yang ekspresif (expressive Provider).</li></ol>',
                            'recommendation' => '',
                        ],
                        [
                            'answer' => 'B',
                            'title' => 'Idealis',
                            'indicator' => '<p>Idealis ialah salah satu dari empat kepribadian yang didefinisikan oleh Keirsey dan memiliki keterkaitan dengan tipe NF (intuitive–feeling) Myers-Briggs. Berikut variasi peran tipe Idealis yang berkolerasi dengan tipe Myers-Briggs: Champion (ENFP), Konselor (INFJ), Healer (INFP), dan Pendidik (ENFJ). Seorang Idealis bersifat abstrak dan penuh kasih. Ia memaknai hidup, peduli terhadap pertumbuhan pribadi, dan berkarakter unik. Diplomasi adalah kekuatan terbesarnya. Mereka unggul dalam menjelaskan sesuatu, menyatukan, dan menginspirasi. Dua varian peran dari tipe ini adalah:</p><br/><ol><li>Mentor adalah Idealis yang proaktif. Mereka cakap dalam mengembangkan sesuatu. Dua varian perannya ialah Konselor yang penuh perhatian (attentive Counselor) dan Pendidik yang ekspresif (expressive Teacher).</li><li>Advocate adalah Idealis yang informatif (reaktif). Mereka cakap dalam hal mediasi. Dua varian perannya ialah Penyembuh yang penuh perhatian (attentive Healer) dan Pemenang yang ekspresif (expressive Champion).</li></ol>',
                            'recommendation' => '',
                        ],
                        [
                            'answer' => 'D',
                            'title' => 'Rasional',
                            'indicator' => '<p>Rasional ialah salah satu dari empat kepribadian yang didefinisikan oleh Keirsey dan memiliki keterkaitan dengan tipe NT (intuitive–thinking) Myers-Briggs. Berikut variasi peran tipe Rasional yang berkolerasi dengan tipe Myers-Briggs: Arsitek (INTP), Fieldmarshal (ENTJ), Penemu (ENTP), dan Mastermind (INTJ). Seorang Rasional bersifat abstrak dan objektif. Ia mengejar keahlian dan pengendalian diri. Ia juga memperhatikan pengetahuan dan kompetensi mereka sendiri. Kekuatan terbesar mereka adalah strategi. Mereka unggul dalam segala jenis penyelidikan logis seperti rekayasa, konseptualisasi, teori, dan koordinasi.[8] Dua varian peran dari tipe ini adalah:</p><br/><ol><li>Koordinator adalah Rasional yang proaktif. Mereka cakap saat mengatur suatu hal. Dua varian perannya ialah Perencana yang penuh perhatian (attentive Mastermind) dan Fieldmarshal yang ekspresif (expressive Fieldmarshal).</li><li>Insinyur adalah Rasional yang informatif (reaktif). Mereka cakap dalam penyusunan suatu hal. Dua varian perannya ialah Arsitek yang penuh perhatian (attentive Architect) dan Penemu yang ekspresif (expressive Inventor).</li></ol>',
                            'recommendation' => '',
                        ],
                    ],
                ]
            ],
        ];

        foreach ($quizzes as $quiz) {
            $newQuiz = Quiz::create([
                'name' => $quiz['name'],
                'estimation_time' => $quiz['estimation_time'],
                'content_coverage' => $quiz['content_coverage'],
                'assessment_objectives' => $quiz['assessment_objectives'],
                'overview' => $quiz['overview'],
                'user_id' => $quiz['user_id'],
                'quiz_category_id' => $quiz['quiz_category_id'],
                'quiz_phase_id' => $quiz['quiz_phase_id'],
                'is_active' => $quiz['is_active'],
                'type' => $quiz['type'],
                'status' => $quiz['status'],
            ]);

            $rule = $quiz['rule'];
            $newRule = $newQuiz->assessmentRule()->create([
                'type' => $rule['type'],
                'question_type' => $rule['question_type'],
                'max_indicator' => $rule['max_indicator'],
                'max_answer' => $rule['max_answer'],
            ]);

            if (!empty($rule['indicators']))
                foreach ($rule['indicators'] as $indicator) {
                    $newRule->indicators()->create([
                        'answer' => $indicator['answer'] ?? null,
                        'title' => $indicator['title'] ?? null,
                        'indicator' => $indicator['indicator'] ?? null,
                        'recommendation' => $indicator['recommendation'] ?? null,
                        'value_min' => $indicator['value_min'] ?? null,
                        'value_max' => $indicator['value_max'] ?? null,
                    ]);
                }

            $answers = $rule['answers'];
            foreach ($answers as $answer) {
                $newRule->answers()->create([
                    'answer' => $answer['answer'] ?? null,
                    'score' => $answer['score'] ?? null,
                    'default' => $answer['default'] ?? null,
                ]);
            }

            foreach ($quiz['groups'] as $idxGroup => $group) {
                $newGroup = $newQuiz->groups()->create([
                    'name' => $group['name'],
                    'description' => $group['description'],
                    'order' => $idxGroup + 1
                ]);

                if ($quiz['type'] == 'multipleIntelligenceType') {
                    $newRule->indicators()->create([
                        'answer' => $newGroup->id,
                        'title' => $group['name'],
                        'indicator' => $group['indicator'] ?? null,
                        'recommendation' => $group['recommendation'] ?? null,
                        'value_min' => $group['value_min'] ?? null,
                        'value_max' => $group['value_max'] ?? null,
                    ]);
                }

                foreach ($group['questions'] as $idxQuestion => $question) {
                    $newQuestion = $newGroup->questions()->create([
                        'question' => $question['question'],
                        'operator' => $question['operator'] ?? '+',
                        'score' => $question['score'] ?? 1,
                        'order' => $idxQuestion + 1,
                    ]);

                    foreach ($question['answers'] as $answer) {
                        $newQuestion->answers()->create([
                            'answer' => $answer['answer'],
                            'text' => $answer['text'],
                            'score' => $answer['score'] ?? null,
                            'is_correct' => false
                        ]);
                    }
                }
            }
        }
    }
}
