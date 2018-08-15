<?php

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $contentList = [
            [
                'contentable_id' => 1,
                'contentable_type' => 'projects',
                'content' => 'TestProjectBody',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'contentable_id' => 1,
                'contentable_type' => 'issues',
                'content' => 'TestIssueBody',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        Content::insert($contentList);
    }
}
