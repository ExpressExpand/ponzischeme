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
        $user = new User();
        $user->name = 'Taiwo';
        $user->email = 'maxteetechnologies@gmail.com';
        $user->phone = '08152425698';
        $user->referrerUsername = 'maxtee';
        $user->bankName = 'GT Bank';
        $user->accountName = 'Famurewa Taiwo';
        $user->accountNumber = '0027052931';
        $user->password = bcrypt('TANGOjobs#');
        $user->relatedCountryID = '160';
        $user->save();
    }
}
