<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Yuji Nakagawa',
            'email'     => 'nakagawa@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
        ]);

        DB::table('users')->insert([
            'name'      => 'Yui Yuzuki',
            'email'     => 'lucia15iris@gmail.com',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
        ]);

        DB::table('users')->insert([
            'name'      => 'Gumika Aoumi',
            'email'     => 'nakagawa-test1@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
        ]);

        DB::table('users')->insert([
            'name'      => 'Ui Kamishiro',
            'email'     => 'nakagawa-test2@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
        ]);

        DB::table('users')->insert([
            'name'      => 'Moku hiyochan',
            'email'     => 'nakagawa-mokuhiyo@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
        ]);
    }
}
