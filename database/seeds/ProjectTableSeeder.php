<?php

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'title' => 'TestProject',
            'status' => 1,
            'priority' => 2,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
