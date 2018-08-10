<?php

use Illuminate\Database\Seeder;
use App\Models\File;

class FileTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $fileList = [
            [
                'fileable_id' => 1,
                'fileable_type' => 'projects',
                'file_name' => 'TestProjectFileName',
                'file_path' => 'TestProjectFilePath',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'fileable_id' => 1,
                'fileable_type' => 'issues',
                'file_name' => 'TestIssueFileName',
                'file_path' => 'TestIssueFilePath',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'fileable_id' => 1,
                'fileable_type' => 'contents',
                'file_name' => 'TestContentFileName',
                'file_path' => 'TestContentFilePath',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        File::insert($fileList);
    }
}
