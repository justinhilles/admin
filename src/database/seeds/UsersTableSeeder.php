<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	// DB::table('pages')->delete();

        $users = array(
        	array(
        		'username' => 'admin', 
        		'password' => Hash::make('password'), 
        		'email' => 'admin@admin.com'),


        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}