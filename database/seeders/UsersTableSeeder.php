<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed_users = [
            [
                'name' => "user1",
                'email' => "user1@mail.com",
                'password' => bcrypt('12345678'), 
            ],
            [
                'name' => "user2",
                'email' => "user2@mail.com",
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => "user3",
                'email' => "user3@mail.com",
                'password' => bcrypt('12345678'),
            ],
        ];

        User::insert($seed_users);
    }
}
