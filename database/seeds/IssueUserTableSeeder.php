<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueUserTableSeeder extends Seeder
{

    public function run()
    {
        $now = now();
        DB::table('issue_user')->insert([
            'issue_id' => 1,
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
