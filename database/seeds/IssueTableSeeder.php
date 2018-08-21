<?php

use Illuminate\Database\Seeder;
use App\Models\Issue;

class IssueTableSeeder extends Seeder
{
    public function run()
    {
        Issue::create([
            'project_id' => 1,
            'type_id' => 1,
            'title' => 'TestIssue',
            'status' => 1,
            'priority' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
