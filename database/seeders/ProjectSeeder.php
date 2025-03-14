<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'name' => 'Project Alpha',
            'status' => 'active',
        ]);

        Project::create([
            'name' => 'Project Beta',
            'status' => 'completed',
        ]);
    }
}
