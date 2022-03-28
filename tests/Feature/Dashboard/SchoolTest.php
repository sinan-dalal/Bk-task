<?php

namespace Tests\Feature\Dashboard;

use App\Models\School;
use Tests\Feature\BaseTestCase;

class SchoolTest extends BaseTestCase
{
    protected string $endpoint   = '/api/dashboard/schools';
    protected string $table_name = 'schools';

    public function setUp(): void
    {
        parent::setUp();

        $this->loginAsAdmin();
    }

    public function testCreateSchool(): void
    {
        $payload = School::factory()->make(['name' => 'test name'])->toArray();

        $this->json('POST', $this->endpoint, $payload)
            ->assertStatus(201)
            ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->table_name, ['name' => 'test name']);
    }

    public function testListAllSchools()
    {
        $schools = School::factory()->count(5)->create();

        $this->json('GET', $this->endpoint)
            ->assertJsonCount(5, 'data')
            ->assertSee($schools[2]['name'])
            ->assertStatus(200);
    }

    public function testShowSchool()
    {
        $school = School::factory()->create();

        $this->json('GET', "$this->endpoint/$school->id")
            ->assertSee($school->name)
            ->assertStatus(200);
    }

    public function testUpdateSchool()
    {
        $school = School::factory()->create();

        $payload = School::factory()->make()->toArray();


        $this->json('PATCH', "$this->endpoint/$school->id", $payload)
            ->assertStatus(200);

        $this->assertDatabaseHas($this->table_name, ['name' => $payload['name']]);
    }

    public function testDeleteSchool()
    {
        $school_count = School::count();

        $school = School::factory()->create()->first();

        $this->json('DELETE', "$this->endpoint/$school->id")
            ->assertStatus(204);

        $this->assertEquals($school_count, School::count());

        $this->json('GET', "$this->endpoint/$school->id")
            ->assertStatus(404);
    }

}
