<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('role',"superadmin")->first();
        if(is_null($user)){
            $user = new User();
            $user->role = "superadmin";
            $user->name = "Mohammad Farhad";
            $user->email = "farhad@gmail.com";
            $user->password = Hash::make('1234567890'); 
            $user->save();
        }
    }
}
