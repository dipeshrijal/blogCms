<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
        	[
        		'name' => 'Dipesh',
        		'email' => 'dipesh@blogcms.app',
        		'password' => bcrypt('secret'),
        	],
        	[
        		'name' => 'Amina',
        		'email' => 'amina@blogcms.app',
        		'password' => bcrypt('secret'),
        	],
        	[
        		'name' => 'Samira',
        		'email' => 'samira@blogcms.app',
        		'password' => bcrypt('secret'),
        	]
        ]);
    }
}
