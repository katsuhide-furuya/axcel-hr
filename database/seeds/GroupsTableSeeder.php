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
            'group_name'       => 'Test Period',
            'evaluators'       => json_encode(array('Yuji Nakagawa', 'Yui Yuzuki', 'Gumika Aoumi', 'Ui Kamishiro'), JSON_PRETTY_PRINT),
            'evaluators_count' => 4,
            'valuators'        => json_encode(array('Moku Hiyochan', 'Moku Hiyochan', 'Moku Hiyochan', 'Moku Hiyochan'), JSON_PRETTY_PRINT),
            'valuators_count'  => 1
        ]);
    }
}
