<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Usuario Admin',
                'password' => bcrypt('00000000'),
                'telefono' => '71313131',
                'estado' => 'A',
            ]
        );

        $user->assignRole('admin');
    }
}
