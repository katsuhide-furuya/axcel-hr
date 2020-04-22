<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'group_name'      => 'テストグループ1',
            'evaluatee'       => json_encode([
                '0' => '1',
                '1' => '2',
                '2' => '3',
                '3' => '4'
            ], JSON_PRETTY_PRINT),
            'evaluatee_count' => 4,
            'rater'           => json_encode([
                '0' => '5',
                '1' => '5',
                '2' => '5',
                '3' => '5'
            ], JSON_PRETTY_PRINT),
            'rater_count'     => 1
        ]);
    }
}
