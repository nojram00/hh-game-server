<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $data = \App\Models\User::factory()->create([
            'name' => 'studentdummy',
            'email' => 'test@example.com',
            'password' => 'student123',
            'role' => User::ROLES['2']
        ]);

        $teacher_user = User::factory()->create([
            'name' => 'teacherdummy',
            'email' => 'teacher@example.com',
            'password' => 'teacher123'
        ]);

        $teacher = Teacher::factory()->create([
            'user_id' => $teacher_user->id,
            'firstname' => 'Juanito',
            'lastname' => 'Bayagbag'
        ]);

        $section = Section::factory()->create([
            'teacher_id' => $teacher->id,
            'section_name' => 'Gemini'
        ]);

        Student::factory()->create([
            'user_id' => $data->id,
            'section_id' => $section->id,
            'firstname' => 'Cardo',
            'lastname' => 'Dalisay'
        ]);
    }
}
