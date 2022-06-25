<?php

namespace Database\Seeders;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $permissions=Permissions::all();
        // $roles = Roles::create(
        //     [
        //         'role_title' => 'Super Admin',
        //         'description' => 'Role created by default',
        //         'outlet_id' => $request->outlet_id,
        //         'created_by' => $request->created_by
        //     ]
        // );

        // $roles->permissions()->sync($request->input('permission_id', []));
    }
}
