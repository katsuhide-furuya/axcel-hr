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
            'name'      => '中川 裕二',
            'email'     => 'nakagawa@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
            'role'      => 10,
        ]);

        DB::table('users')->insert([
            'name'      => '柚木 結衣',
            'email'     => 'lucia15iris@gmail.com',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
            'role'      => 20,
        ]);

        DB::table('users')->insert([
            'name'      => '碧海 らむね',
            'email'     => 'nakagawa-lamune@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
            'role'      => 30,
        ]);

        DB::table('users')->insert([
            'name'      => '紅星 陽奈',
            'email'     => 'nakagawa-corona@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
            'role'      => 30,
        ]);

        DB::table('users')->insert([
            'name'      => 'もくひよちゃん',
            'email'     => 'nakagawa-mokuhiyo@axcel-mode.co.jp',
            'password'  => bcrypt('aaaa1111'),
            'api_token' => Str::random(80),
            'role'      => 10,
        ]);
    }
}
