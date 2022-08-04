<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\Teacher;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ManageStudentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_view_all_students()
    {
        $this->signIn();

        $student = Student::factory()
            ->for(Teacher::factory())
            ->create();

        $this->get(route('students.index'))
            ->assertOk()
            ->assertSee($student->name);

    }

    public function test_it_can_create_a_student()
    {
        $this->signIn();

        $teacher = Teacher::factory()->create();

        $data = Student::factory()->raw([
            'teacher_id' => $teacher->id
        ]);

        $this->post(route('students.store'), $data);

        $this->assertDatabaseHas('students', $data);
    }

    public function test_it_can_update_a_student()
    {
        $this->signIn();

        $student = Student::factory()->for(Teacher::factory())->create();
        $data = Student::factory()->raw([
            'teacher_id' => $student->teacher_id
        ]);

        $this->put(route('students.update', $student), $data);

        $this->assertDatabaseHas('students', $data);
    }

    public function test_it_can_delete_student()
    {
        $this->signIn();

        $student = Student::factory()->for(Teacher::factory())->create();

        $this->delete(route('students.destroy', $student));

        $this->assertDatabaseMissing('students', $student->toArray());
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_student_validations(array $payload, string $key)
    {
        $this->signIn();

        $response = $this->post(route('students.store'), $payload);

        $response->assertSessionHasErrors($key);
    }

    // DataProviders
    public function validationProvider(): Generator
    {
        $defaultPayload = [
            'name' => 'Test User',
            'age' => 18,
            'gender' => 'm',
            'teacher_id' => 1,
        ];

        yield from [
            'missing_name' => [
                'payload' => Arr::except($defaultPayload, 'name'),
                'key' => 'name',
            ],
            'missing_age' => [
                'payload' => Arr::except($defaultPayload, 'age'),
                'key' => 'age',
            ],
            'missing_gender' => [
                'payload' => Arr::except($defaultPayload, 'gender'),
                'key' => 'gender',
            ],
            'missing_teacher_id' => [
                'payload' => Arr::except($defaultPayload, 'teacher_id'),
                'key' => 'teacher_id',
            ],
        ];
    }
}
