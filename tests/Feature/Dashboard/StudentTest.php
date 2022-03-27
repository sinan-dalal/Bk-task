<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use Tests\Feature\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends BaseTestCase
{
    use  RefreshDatabase;

    protected $endpoint   = 'api/dashboard/students';
    protected $table_name = 'students';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateStudent(): void
    {
        $this->loginAsAdmin();

        School::factory(5)->create();

        $payload = Student::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
            ->assertStatus(201)
            ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->table_name, ['id' => 1]);
    }

    public function testViewAllStudentsSuccessfully(): void
    {
        $this->loginAsAdmin();

        Student::factory(5)->create();

        $this->json('GET', $this->endpoint)
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertSee(Student::first(rand(1, 5))->name);
    }

    public function testsCreateStudentValidation(): void
    {
        $this->loginAsAdmin();

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
            ->assertStatus(422);
    }

    public function testViewStudentData(): void
    {
        $this->loginAsAdmin();

        $student = Student::factory()->create();

        $this->json('GET', $this->endpoint . "/$student->id")
            ->assertSee(Student::first()->name)
            ->assertStatus(200);
    }

    public function testUpdateStudent(): void
    {
        $this->loginAsAdmin();

        $student = Student::factory()->create();

        $payload = Student::factory()->make(['school_id'=>$student->id])->toArray();

        $this->json('PUT', $this->endpoint . "/$student->id", $payload)
            ->assertStatus(200)
            ->assertSee($payload['name']);
    }

    public function testDeleteStudent(): void
    {
        $this->loginAsAdmin();

        $student = Student::factory()->create();

        $this->json('DELETE', $this->endpoint . "/$student->id")
            ->assertStatus(204);

        $this->assertEquals(0, Student::count());
    }
}
