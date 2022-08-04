<?php

namespace Tests\Unit;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarkTest extends TestCase
{
    use RefreshDatabase;

    public function test_mark_belongs_to_a_student()
    {
        $student = Student::factory()
            ->for(Teacher::factory())
            ->create();

        $mark = Mark::factory()->create([
            'student_id' => $student->id
        ]);

        $this->assertInstanceOf(Student::class, $mark->student);
    }
}
