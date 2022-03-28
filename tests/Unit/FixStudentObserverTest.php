<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\School;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FixStudentObserverTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatingStudentObserver(): void
    {
        $school = School::factory()->create();

        Student::factory()->create([
            'school_id' => $school->id,
            'name' => 'First student',
        ]);

        Student::factory()->create([
            'school_id' => $school->id,
            'name' => 'Second student'
        ]);

        $this->assertDatabaseHas('students',
            [
                'name' => 'First student',
                'order' => 1
            ]);

        $this->assertDatabaseHas('students',
            [
                'name' => 'Second student',
                'order' => 2
            ]
        );
    }
}
