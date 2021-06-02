<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Běžný',
            'Kuchař',
            'Šéfkuchař',
            'Manažer',
            'Admin',
        ];

        foreach ($roles as $role)
        {
            DB::table('user_roles')->insert([
                'name' => $role,
            ]);
        }

    }
}
