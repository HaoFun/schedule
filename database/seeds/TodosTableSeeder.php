<?php

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodosTableSeeder extends Seeder
{
    public function run()
    {
        $time_now = now();
        $todos = [
            [
                'user_id' => 1,
                'is_done' => 1,
                'todo' => 'todo1',
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'user_id' => 1,
                'is_done' => 0,
                'todo' => 'todo2',
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'user_id' => 1,
                'is_done' => 1,
                'todo' => 'todo3',
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'user_id' => 1,
                'is_done' => 0,
                'todo' => 'todo4',
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'user_id' => 1,
                'is_done' => 0,
                'todo' => 'todo5',
                'created_at' => $time_now,
                'updated_at' => $time_now
            ],
            [
                'user_id' => 1,
                'is_done' => 0,
                'todo' => 'todo6',
                'created_at' => $time_now,
                'updated_at' => $time_now
            ]
        ];
        Todo::insert($todos);
    }
}
