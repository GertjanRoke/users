<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'super admin',
            'created_at' => date('c'),
            'updated_at' => date('c')
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'created_at' => date('c'),
            'updated_at' => date('c')
        ]);
    }
}
