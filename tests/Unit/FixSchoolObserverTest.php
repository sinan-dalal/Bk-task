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
        ])->toArray();

        $student2 = Student::factory()->create([
            'school_id' => $school->id
        ])->toArray();

        $student3 = Student::factory()->create([
            'school_id' => $school->id
        ])->toArray();

        $school->delete();

        unset($student1['created_at']);
        unset($student2['created_at']);
        unset($student3['created_at']);
        unset($student1['updated_at']);
        unset($student2['updated_at']);
        unset($student3['updated_at']);

        $this->assertSoftDeleted('students', $student1);
        $this->assertSoftDeleted('students', $student2);
        $this->assertSoftDeleted('students', $student3);
    }
}
