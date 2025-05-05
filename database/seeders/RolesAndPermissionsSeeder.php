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
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        $reclutador = Role::firstOrCreate(['name' => 'reclutador']);
        $reclutador->givePermissionTo(['create-posts', 'edit-posts']);

        $candidato = Role::firstOrCreate(['name' => 'candidato']);
        $candidato->givePermissionTo(['view-dashboard']);
    }
}
