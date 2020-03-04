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
        // disable foreign key checks before calling seeders for post and comment seeders https://stackoverflow.com/a/28005195/1446598
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $this->call(UserSeeder::class);
        $this->call(TodoItemSeeder::class);
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
