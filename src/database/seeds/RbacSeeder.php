<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RbacUserTableSeeder::class);
        $this->call(RbacMenuTableSeeder::class);
        $this->call(RbacRoleTableSeeder::class);
        $this->call(RbacAccessTableSeeder::class);
    }
}
