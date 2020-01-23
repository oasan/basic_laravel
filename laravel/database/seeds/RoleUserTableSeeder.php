<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('name', 'admin')->first();
        $role = DB::table('roles')->where('alias', 'admin')->first();

        DB::table('role_user')->insert([
            'role_id' => $user->id,
            'user_id' => $role->id,
        ]);
    }
}
