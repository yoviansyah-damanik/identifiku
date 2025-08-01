<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Str;
use App\Models\Administrator;
use App\Models\UserHasRelation;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(1)
            ->create()
            ->each(function ($user, $idx) {
                $user->assignRole('Superadmin');
                $user->update(['username' => 'superadmin-' . $idx + 1]);

                $administrator = (Administrator::factory()->create([
                    'name' => 'Superadmin'
                ]))
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => Administrator::class,
                    'modelable_id' => $administrator
                ]);
            });

        User::factory()
            ->count(1)
            ->create()
            ->each(function ($user, $idx) {
                $user->update(['username' => 'administrator-' . $idx + 1]);
                $user->assignRole('Administrator');

                $administrator = (Administrator::factory()->create([
                    'name' => 'Administrator ' . $idx + 1
                ]))
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => Administrator::class,
                    'modelable_id' => $administrator
                ]);
            });


        User::factory()
            ->count(1)
            ->create()
            ->each(function ($user, $idx) {
                $user->update(['username' => 'school-' . $idx + 1]);
                $user->assignRole('School');

                // $school = (School::factory()->create())
                //     ->id;
                $province_id = \App\Models\Region::province()->where('code', '12')->inRandomOrder()->first()->code;
                $regency_id = \App\Models\Region::regency($province_id)->where('code', '12.77')->first()->code;
                $district_id = \App\Models\Region::district($regency_id)->where('code', '12.77.01')->first()->code;
                $village_id = \App\Models\Region::village($district_id)->where('code', '12.77.01.1005')->first()->code;
                $school = (School::factory()->create([
                    'name' => 'YPKS',
                    'npsn' => fake()->numerify('########'),
                    'nss' => fake()->numerify('########'),
                    'nis' => fake()->numerify('######'),
                    'postal_code' => '22716',
                    'phone_number' => '',
                    'address' => 'JL.SUTAN SORIPADA MULIA NO .52 A KOTA PADANGSIDIMPUAN',
                    'province_id' => $province_id,
                    'regency_id' => $regency_id,
                    'district_id' => $district_id,
                    'village_id' => $village_id,
                    'school_status_id' => 2,
                    'education_level_id' => 3,
                    'token' => Str::random(8)
                ]))
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => School::class,
                    'modelable_id' => $school
                ]);
            });

        // User::factory()
        //     ->count(10)
        //     ->create()
        //     ->each(function ($user, $idx) {
        //         $user->update(['username' => 'student-' . $idx + 1]);
        //         $user->assignRole('Student');

        //         $student = (Student::factory()->create())
        //             ->id;

        //         UserHasRelation::create([
        //             'user_id' => $user->id,
        //             'modelable_type' => Student::class,
        //             'modelable_id' => $student
        //         ]);
        //     });

        // User::factory()
        //     ->count(2)
        //     ->create()
        //     ->each(function ($user, $idx) {
        //         $user->update(['username' => 'teacher-' . $idx + 1]);
        //         $user->assignRole('Teacher');

        //         $teacher = (Teacher::factory()->create())
        //             ->id;

        //         UserHasRelation::create([
        //             'user_id' => $user->id,
        //             'modelable_type' => Teacher::class,
        //             'modelable_id' => $teacher
        //         ]);
        //     });
    }
}
