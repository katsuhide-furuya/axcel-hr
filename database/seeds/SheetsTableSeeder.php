<?php

use Illuminate\Database\Seeder;

class SheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sheets')->insert([
            'period_id'         => 1,
            'sheet_name'        => '目標設定シート',
            'sheet_title'       => 'テスト目標設定',
            'sheet_description' => 'テクニカルスキルの向上',
            'sheet_kind'        => 'OBJECTIVE',
            'sheet_style'       => 3,
            'sheet_group'       => 1
        ]);

        DB::table('sheets')->insert([
            'period_id'         => 1,
            'sheet_name'        => '進捗確認シート',
            'sheet_title'       => '進捗確認の記録をしましょう',
            'sheet_description' => '進捗確認の形式は自由ですが、最低でも隔月に1度は面談形式で行うことを推奨します',
            'sheet_kind'        => 'PROGRESS',
            'sheet_style'       => 6,
            'sheet_group'       => 1
        ]);
    }
}
