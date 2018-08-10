<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTrackerTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        DB::table('project_tracker')->insert([
            [
                'project_id' => 1,
                'tracker_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'project_id' => 1,
                'tracker_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
