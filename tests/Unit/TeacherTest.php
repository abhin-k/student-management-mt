<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_has_many_students()
    {
        $teacher = Teacher::factory()
            ->has(Student::factory()->count(4))
            ->create();

        $this->assertInstanceOf(Collection::class, $teacher->students);
    }
}
