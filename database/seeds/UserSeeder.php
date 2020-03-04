<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Sample user records
     * @var array
     */
    private $users = [
        ['name' => 'John', 'email' => 'johndoe@example.com', 'password' => '12345678'],
        ['name' => 'Alice', 'email' => 'alicedoe@example.com', 'password' => '12345678'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->users as $user) {
            User::firstOrCreate([
              'name' => $user['name'],
              'email' => $user['email'], 
              'password' => Hash::make($user['password']) 
            ]);
          }
    }
}