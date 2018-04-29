<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
            'name' => 'admin',
            'email' => 'admin@orizin.com',
            'password' => bcrypt('adminorizin'),
            'dob' => '1999-07-07',
            'picture' => 'jpg',
            'role'=>'admin',
        ]);

    	User::create([
            'name' => 'andrew',
            'email' => 'andrew@orizin.com',
            'password' => bcrypt('asdasd'),
            'dob' => '1999-07-07',
            'picture' => 'png',
            'role'=>'',
        ]);
    }
}
