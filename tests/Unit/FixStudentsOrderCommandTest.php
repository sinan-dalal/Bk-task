<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\School;
use App\Models\Student;
use App\Events\FinishedSorting;
use Illuminate\Support\Facades\Event;
use App\Console\Commands\ReorderStudents;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FixStudentsOrderCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testCommandCanFixAllCodeGaps(): void
    {
        Event::fake([
            FinishedSorting::class,
        ]);

        //create schools and users in it
        $school_1 = School::factory()->create();

        $school_2 = School::factory()->create();

        $student_1 = Student::factory()->create([
            'school_id' => $school_1->id,
            'name' => 'First student',
        ]);

        $student_2 = Student::factory()->create([
            'school_id' => $school_1->id,
            'name' => 'Second student'
        ]);

        $student_3 = Student::factory()->create([
            'school_id' => $school_2->id,
            'name' => 'Third student',
        ]);

        // assert students save in database with correct order
        $this->assertDatabaseHas('students', [
            'name' => 'First student',
            'order' => 1
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'Second student',
            'order' => 2
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'Third student',
            'order' => 1
        ]);

        $student_1->forceDelete();

        //run command
        $this->artisan(ReorderStudents::class);
        //assert there is no gab in code

        $this->assertDatabaseMissing('students', [
            'name' => 'First student',
            'order' => 1
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'Second student',
            'order' => 1
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'Third student',
            'order' => 1
        ]);

        Event::assertDispatched(FinishedSorting::class);
    }
}
