<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::where('email', '=', 'example@example.com')->first();
        $superAdminRole = Role::where('name', '=', 'super admin')->first();
        if($superAdmin && $superAdminRole){
            DB::table('role_user')->insert([
                'role_id' => $superAdminRole->id,
                'user_id' => $superAdmin->id,
                'created_at' => date('c'),
                'updated_at' => date('c')
            ]);
        }
        $admin = User::where('email', '=', 'admin@admin.com')->first();
        $adminRole = Role::where('name', '=', 'admin')->first();
        if($admin && $adminRole){
            DB::table('role_user')->insert([
                'role_id' => $adminRole->id,
                'user_id' => $admin->id,
                'created_at' => date('c'),
                'updated_at' => date('c')
            ]);
        }
    }
}
