<?php

namespace Tests\Unit;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_belongs_to_a_teacher()
    {
        $teacher = Teacher::factory()->create();

        $student = Student::factory()->create([
            'teacher_id' => $teacher->id
        ]);

        $this->assertInstanceOf(Teacher::class, $student->teacher);
    }

    public function test_student_has_marks()
    {
        $student = Student::factory()
            ->for(Teacher::factory())
            ->create();

        $mark = Mark::factory()->create([
            'student_id' => $student->id
        ]);

        $this->assertInstanceOf(Collection::class, $student->marks);
    }
}
