<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //attach user to row
        // $user = User::findorfail(1)->first();
        // $role = Role::where('name', 'superadmin')->first();
        // $user->attachRole($role->id);
    }
}
