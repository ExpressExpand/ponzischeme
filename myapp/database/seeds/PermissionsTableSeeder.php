<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\User;
use App\Role;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'match-user';
        $permission->display_name = 'Have the ability to match users';
        $permission->description = 'User having this permission will be able to match';
        $permission->save();
    	
        //attach the permissions to user
        $roles = Role::all();
        foreach($roles as $role) {
        	if($role->name == 'superadmin'){
        		$role->attachPermission($permission);
        	}
        }
    }
}
