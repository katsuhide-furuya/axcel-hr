<?php

use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert([
            'period_name' => 'Test Period',
            'start_date'  => '2020-04-01',
            'end_date'    => '2020-12-31',
            'status'      => 0
        ]);
    }
}
