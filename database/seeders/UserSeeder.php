<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Administrator;
use App\Models\UserHasRelation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

                $administrator = (Administrator::factory()->create())
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => Administrator::class,
                    'modelable_id' => $administrator
                ]);
            });

        User::factory()
            ->count(3)
            ->create()
            ->each(function ($user, $idx) {
                $user->assignRole('Administrator');
                $user->update(['username' => 'administrator-' . $idx + 1]);

                $administrator = (Administrator::factory()->create())
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => Administrator::class,
                    'modelable_id' => $administrator
                ]);
            });


        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                $user->assignRole('School');

                $school = (School::factory()->create())
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => School::class,
                    'modelable_id' => $school
                ]);
            });

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $user->assignRole('Student');

                $student = (Student::factory()->create())
                    ->id;

                UserHasRelation::create([
                    'user_id' => $user->id,
                    'modelable_type' => Student::class,
                    'modelable_id' => $student
                ]);
            });
    }
}
