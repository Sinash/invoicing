<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		\App\User::create([
			'name' => 'Sinash Shajahan',
			'username' => 'sinash',
			'email' => 'sinash@gmail.com',
			'password' => bcrypt('admin123'),
			'confirmed' => 1,
            'admin' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		\App\User::create([
			'name' => 'Aleena Sinash',
			'username' => 'aleena',
			'email' => 'aleena@gmail.com',
			'password' => bcrypt('user123'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

	}

}
