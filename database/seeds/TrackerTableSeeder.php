<?php

use Illuminate\Database\Seeder;
use App\Models\Tracker;

class TrackerTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $trackerList = [
            [
                'tracker_name' => 'Laravel',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tracker_name' => 'PHP',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tracker_name' => 'Node.js',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tracker_name' => 'Vue',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tracker_name' => 'React',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        Tracker::insert($trackerList);
    }
}
