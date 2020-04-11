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
            'name'             => 'Yuji Nakagawa',
            'email'            => 'nakagawa@axcel-mode.co.jp',
            'employee_no'      => '000092',
            'division'         => '1',
            'job_category'     => '1',
            'post'             => null,
            'recruit_category' => '1',
            'employment_status'=> '1',
            'joining_at'       => '2016/04/01'
        ]);

        DB::table('users_info')->insert([
            'name'             => 'Yui Yuzuki',
            'email'            => 'lucia15iris@gmail.com',
            'employee_no'      => '000089',
            'division'         => '1',
            'job_category'     => '1',
            'post'             => null,
            'recruit_category' => '1',
            'employment_status'=> '1',
            'joining_at'       => '2016/04/01'
        ]);
    }
}
