<?php

namespace Database\Seeders;

use App\Models\Timesheet;
use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timesheet::create([
            'task_name' => 'Task 1',
            'date' => now(),
            'hours' => 8.5,
            'user_id' => 1, // Link to the first user
            'project_id' => 1, // Link to the first project
        ]);

        Timesheet::create([
            'task_name' => 'Task 2',
            'date' => now()->subDays(1),
            'hours' => 6.0,
            'user_id' => 2, // Link to the second user
            'project_id' => 2, // Link to the second project
        ]);
    }
}
