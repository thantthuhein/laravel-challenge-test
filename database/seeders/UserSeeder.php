<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@mail.com',
            'password' => bcrypt('abcd1234')
        ]);

        User::factory(100)->create();
    }
}
