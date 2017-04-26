<?php
use Illuminate\Database\Seeder;
use App\Role;
use App\User;

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
		$role->display_name = 'Users'; // optional
		$role->description  = 'These are the registered users'; // optional
		$role->save();

		$role = new Role();
		$role->name = 'admin';
		$role->display_name = 'Admin'; // optional
		$role->description  = 'These are the registered users that are admins'; // optional
		$role->save();

		$role = new Role();
		$role->name = 'managers';
		$role->display_name = 'Managers'; // optional
		$role->description  = 'These are the registered users that are managers'; // optional
		$role->save();

		$role = new Role();
		$role->name = 'superadmin';
		$role->display_name = 'Super Admin'; // optional
		$role->description  = 'These are the registered users that are admins'; // optional
		$role->save();

		$user = User::find(1);

		$user->attachRole($role);
		// $user->hasRole('admin');   // true
		// $user->can('edit-user'); 
    }
}
