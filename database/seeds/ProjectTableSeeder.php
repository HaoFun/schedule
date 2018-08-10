<?php

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'project_name' => 'TestProject',
            'status' => 'created',
            'priority' => 2,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
