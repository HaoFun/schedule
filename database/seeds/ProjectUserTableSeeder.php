<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        DB::table('project_user')->insert([
            'project_id' => 1,
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
