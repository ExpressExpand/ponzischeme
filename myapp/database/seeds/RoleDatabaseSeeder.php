<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
		$role->name = 'users';
		$role->display_name = 'This are all the authenticated users'; // optional
		$role->description  = 'This are the registered users'; // optional
		$role->save();

		$role = new Role();
		$role->name = 'admin';
		$role->display_name = 'This is the admin role'; // optional
		$role->description  = 'This are the registered users that are admins'; // optional
		$role->save();

		$role = new Role();
		$role->name = 'managers';
		$role->display_name = 'This are the managers/moderators'; // optional
		$role->description  = 'This are the registered users that are managers'; // optional
		$role->save();

		// $user->attachRole($admin);
		// $user->hasRole('admin');   // true
		// $user->can('edit-user'); 
    }
}
