<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueTrackerTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        DB::table('issue_tracker')->insert([
            [
                'issue_id' => 1,
                'tracker_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'issue_id' => 1,
                'tracker_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
