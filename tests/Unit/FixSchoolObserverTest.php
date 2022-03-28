<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\School;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FixSchoolObserverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testDeletingSchoolObserver(): void
    {
        $school = School::factory()->create();

        $student1 = Student::factory()->create([
            'school_id' => $school->id
        ]);

        $student2 = Student::factory()->create([
            'school_id' => $school->id
        ]);

        $student3 = Student::factory()->create([
            'school_id' => $school->id
        ]);

        $school->delete();

        $this->assertSoftDeleted('students', $student1->toArray());
        $this->assertSoftDeleted('students', $student2->toArray());
        $this->assertSoftDeleted('students', $student3->toArray());
    }
}
