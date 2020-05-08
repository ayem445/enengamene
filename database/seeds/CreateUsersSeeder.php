<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_list = [
          ['name' => "Kati Frantz", 'username' => "kati.frantz", 'email' => "kati@frantz.com", 'password' => "secret"],
          ['name' => "John Doe", 'username' => "john.doe", 'email' => "john.doe@com", 'password' => "secret"],
        ];

        foreach ($users_list as $user) {
          $user_db = User::where('name',$user['name'])->where('username',$user['username'])->where('email',$user['email'])->first();
          $user['password'] = bcrypt($user['password']);
          if ($user_db) {
            $user_db->update($user);
          } else {
            User::create($user);
          }
        }
    }
}
