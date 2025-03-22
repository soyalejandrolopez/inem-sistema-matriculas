<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si el usuario ya existe
        $existingUser = User::where('email', 'admin@inem.edu.co')->first();
        
        if (!$existingUser) {
            // Crear usuario super admin si no existe
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@inem.edu.co',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ]);
        } else {
            $user = $existingUser;
        }
        
        // Asignar el rol super_admin al usuario (relación muchos a muchos)
        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole) {
            // Verificar si ya tiene el rol asignado
            if (!$user->roles()->where('role_id', $superAdminRole->id)->exists()) {
                $user->roles()->attach($superAdminRole->id);
            }
        }
    }
}
