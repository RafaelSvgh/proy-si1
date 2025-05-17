<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = ['create-posts', 'edit-posts', 'delete-posts', 'view-dashboard'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->givePermissionTo($permissions);

        $reclutador = Role::firstOrCreate(['name' => 'reclutador', 'guard_name' => 'web']);
        $reclutador->givePermissionTo(['create-posts', 'edit-posts']);

        $candidato = Role::firstOrCreate(['name' => 'candidato', 'guard_name' => 'web']);
        $candidato->givePermissionTo(['view-dashboard']);
    }
}
