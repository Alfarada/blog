<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(29)->create();

        User::create([
            'name' => 'lorem ipsum',
            'email' => 'lorem@ipsum.com',
            'password' => bcrypt('123')
        ]);
    }
}
