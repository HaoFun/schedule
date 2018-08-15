<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        DB::table('types')->insert([
            [
                'type_name' => '提案',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'type_name' => '報價',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'type_name' => '排版',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'type_name' => '研究',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'type_name' => '設計',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'type_name' => '編輯',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'type_name' => '程式',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
