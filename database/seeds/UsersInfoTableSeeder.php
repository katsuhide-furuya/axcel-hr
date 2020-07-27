<?php

use Illuminate\Database\Seeder;

class UsersInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_info')->insert([
            'name'              => '中川 裕二',
            'email'             => 'nakagawa@axcel-mode.co.jp',
            'employee_no'       => '000092',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2016/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => '柚木 結衣',
            'email'             => 'lucia15iris@gmail.com',
            'employee_no'       => '000001',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2017/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => '碧海 らむね',
            'email'             => 'nakagawa-lamune@axcel-mode.co.jp',
            'employee_no'       => '000002',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2018/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => '紅星 陽奈',
            'email'             => 'nakagawa-corona@axcel-mode.co.jp',
            'employee_no'       => '000003',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2019/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => 'もくひよちゃん',
            'email'             => 'nakagawa-mokuhiyo@axcel-mode.co.jp',
            'employee_no'       => '100000',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => 2,
            'recruit_category'  => 1,
            'employment_status' => 0,
            'joining_at'        => '2016/04/01'
        ]);
    }
}
