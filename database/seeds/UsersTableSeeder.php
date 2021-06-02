<?php

use Illuminate\Database\Seeder;

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
            'email' => 'admin@kuchtit.cz',
            'name' => 'Kuchtit Admin',
            'slug' => 'admin',
            'bio' => 'Šedá eminence',
            'verified' => true,
            'role_id' => 5,
            'password' => bcrypt('root'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'email' => 'info@kuchtit.cz',
            'name' => 'Kuchtit Manažer',
            'slug' => 'manager',
            'verified' => true,
            'role_id' => 4,
            'password' => bcrypt('root'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        factory('App\User', 2)->create();


    }
}
