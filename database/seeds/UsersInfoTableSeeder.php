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
            'name'              => 'Yuji Nakagawa',
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
            'name'              => 'Yui Yuzuki',
            'email'             => 'lucia15iris@gmail.com',
            'employee_no'       => '000001',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2016/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => 'Gumika Aoumi',
            'email'             => 'nakagawa-test1@axcel-mode.co.jp',
            'employee_no'       => '000002',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2016/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => 'Ui Kamishiro',
            'email'             => 'nakagawa-test2@axcel-mode.co.jp',
            'employee_no'       => '000003',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2016/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'              => 'Moku Hiyochan',
            'email'             => 'nakagawa-mokuhiyo@axcel-mode.co.jp',
            'employee_no'       => '100000',
            'division'          => 1,
            'job_category'      => 1,
            'post'              => null,
            'recruit_category'  => 0,
            'employment_status' => 0,
            'joining_at'        => '2016/04/01'
        ]);
    }
}
