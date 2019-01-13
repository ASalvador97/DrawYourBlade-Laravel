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
		$user = new User;
		$user->name = 'user1';
		$user->email = 'user1@usr.usr';
		$user->password = bcrypt('pass');
		$user->avatarDir = 'userContent/defaultAvatars/boy.png';
		$user->save();
		
		
		$user = new User;
		$user->name = 'user2';
		$user->email = 'user2@usr.usr';
		$user->password = bcrypt('pass');
		$user->avatarDir = 'userContent/defaultAvatars/grill.png';
		$user->save();
		
		$user = new User;
		$user->name = 'admin';
		$user->email = 'admin@admin.admin';
		$user->password = bcrypt('pass');
		$user->type = 'admin';	
		$user->avatarDir = 'userContent/defaultAvatars/boy.png';
		$user->save();
		
    }
}
