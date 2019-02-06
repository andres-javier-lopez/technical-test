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
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@email.com';
        $admin->password = bcrypt('123456');
        $admin->is_admin = true;
        $admin->save();

        $user = new User();
        $user->name = 'test';
        $user->email = 'test@email.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
