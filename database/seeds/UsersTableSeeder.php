<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//Default test user for demo
    	//Also make faker for more
        User::updateOrCreate(['name'=>'John Deo', 'email'=>'john@deo.com', 'password'=>bcrypt('@Jonny@')]);
    }
}
