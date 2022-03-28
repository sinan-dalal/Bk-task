<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;
use App\Events\FinishedSorting;
use Illuminate\Support\Facades\DB;

class ReorderStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reorder:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes the orders of students in each school';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $schools = School::all();
            foreach ($schools as $school) {
                $count = 1;
                foreach ($school->students as $student) {
                    $student['order'] = $count++;
                    $student->update();
                }
            }
            event(new FinishedSorting('Students sorted successfully'));
            $this->info('Students sorted successfully');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            event(new FinishedSorting('Sorting students failed, please try again'));
            $this->error('Sorting students failed, please try again');
        }

        return 0;
    }
}
