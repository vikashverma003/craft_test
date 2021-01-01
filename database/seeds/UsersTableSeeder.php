<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "sam",
            'email' => 'sam@gmail.com',
            'password' => bcrypt('password'),
        ]);
         DB::table('users')->insert([
            'name' => "sam2",
            'email' => 'sam2@gmail.com',
            'password' => bcrypt('password'),
        ]);
         DB::table('users')->insert([
            'name' => "sam3",
            'email' => 'sam3@gmail.com',
            'password' =>bcrypt('password'),
        ]);

          DB::table('users')->insert([
            'name' => "sam4",
            'email' => 'sam4@gmail.com',
            'password' => bcrypt('password'),
        ]);
           DB::table('users')->insert([
            'name' => "sam5",
            'email' => 'sam5@gmail.com',
            'password' => bcrypt('password'),
        ]);
            DB::table('users')->insert([
            'name' => "sam6",
            'email' => 'sam6@gmail.com',
            'password' => bcrypt('password'),
        ]);

             DB::table('users')->insert([
            'name' => "sam7",
            'email' => 'sam7@gmail.com',
            'password' => bcrypt('password'),
        ]);
              DB::table('users')->insert([
            'name' => "sam8",
            'email' => 'sam8@gmail.com',
            'password' => bcrypt('password'),
        ]);
               DB::table('users')->insert([
            'name' => "sam9",
            'email' => 'sam9@gmail.com',
            'password' => bcrypt('password'),
        ]);
                DB::table('users')->insert([
            'name' => "sam10",
            'email' => 'sam10@gmail.com',
            'password' => bcrypt('password'),
        ]);

    }
}
