<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignUsersToProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        if ($users->isEmpty() || $projects->isEmpty()) {
            $this->command->info('No users or projects found. Please seed users and projects first.');
            return;
        }

        $projects->each(function ($project) use ($users) {
            // Randomly select between 1 and 3 users for each project
            $randomUsers = $users->random(rand(1, 3));

            $project->users()->attach(
                $randomUsers->pluck('id')->toArray(),
                ['created_at' => now(), 'updated_at' => now()] // Optional: Add timestamps
            );
        });

        $this->command->info('Users have been successfully assigned to projects.');
    }
}
