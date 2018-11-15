<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(User::all()) >1) {
            return false;
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@dotntick.com',
            'password' => bcrypt('helloworld'),
        ]);
    }
}
