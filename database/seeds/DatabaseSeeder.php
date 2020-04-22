<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UsersInfoTableSeeder::class);
        $this->call(CompanyInfoTableSeeder::class);
        $this->call(PeriodsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(SheetsTableSeeder::class);
        $this->call(SheetEntityTableSeeder::class);
    }
}
