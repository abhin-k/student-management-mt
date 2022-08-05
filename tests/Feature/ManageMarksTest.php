<?php

namespace Tests\Feature;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use Generator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;

class ManageMarksTest extends TestCase
{
    use RefreshDatabase;

    private $student;

    public function setUp():void
    {
        parent::setUp();

        $this->signIn();

        $this->student = Student::factory()
            ->for(Teacher::factory())
            ->create();
    }

    public function test_it_can_view_all_marks()
    {
        $marks = Mark::factory()->create([
            'student_id' => $this->student->id
        ]);

        $this->get(route('marks.index'))
            ->assertOk()
            ->assertSee($marks->total);
    }

    public function test_it_can_create_marks()
    {
        $data = Mark::factory()->raw([
            'student_id' => $this->student->id
        ]);

        $this->post(route('marks.store'), $data);
        $this->assertDatabaseHas('marks', $data);
    }

    public function test_it_can_update_marks()
    {
        $mark = Mark::factory()->create([
            'student_id' => $this->student->id
        ]);

        $data = Mark::factory()->raw();

        $this->put(route('marks.update', $mark), $data);

        $this->assertDatabaseHas('marks', $data);
    }

    public function test_it_can_delete_marks()
    {
        $mark = Mark::factory()->create([
            'student_id' => $this->student->id
        ]);

        $this->delete(route('marks.destroy', $mark));

        $this->assertDatabaseMissing('marks', $mark->toArray());
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_student_validations(array $payload, string $key)
    {
        $response = $this->post(route('marks.store'), $payload);

        $response->assertSessionHasErrors($key);
    }

    // DataProviders
    public function validationProvider(): Generator
    {
        $defaultPayload = [
            'maths' => 10,
            'science' => 20,
            'history' => 30,
            'term' => 'one',
            'total' => 60,
            'student_id' => 1
        ];

        yield from [
            'missing_maths' => [
                'payload' => Arr::except($defaultPayload, 'maths'),
                'key' => 'maths',
            ],
            'missing_science' => [
                'payload' => Arr::except($defaultPayload, 'science'),
                'key' => 'science',
            ],
            'missing_history' => [
                'payload' => Arr::except($defaultPayload, 'history'),
                'key' => 'history',
            ],
            'missing_term' => [
                'payload' => Arr::except($defaultPayload, 'term'),
                'key' => 'term',
            ],
            'missing_student_id' => [
                'payload' => Arr::except($defaultPayload, 'student_id'),
                'key' => 'student_id',
            ],
        ];
    }
}
