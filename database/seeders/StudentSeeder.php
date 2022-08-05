<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory(2)->create([
            'teacher_id' => Teacher::first()->id
        ])->each(function ($student) {
            $student->marks()->save(Mark::factory()->make());
        });
    }
}
