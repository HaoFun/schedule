<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(TrackerTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(IssueTableSeeder::class);
        $this->call(ContentTableSeeder::class);
        $this->call(FileTableSeeder::class);
        $this->call(ProjectUserTableSeeder::class);
        $this->call(IssueUserTableSeeder::class);
        $this->call(ProjectTrackerTableSeeder::class);
        $this->call(IssueTrackerTableSeeder::class);
    }
}
