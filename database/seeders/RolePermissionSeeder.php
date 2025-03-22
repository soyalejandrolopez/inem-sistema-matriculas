<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles básicos
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Administrador del sistema con acceso a todas las funcionalidades'
            ],
            [
                'name' => 'user',
                'display_name' => 'Usuario',
                'description' => 'Usuario regular del sistema'
            ],
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrador',
                'description' => 'Acceso completo al sistema, incluyendo la gestión de roles y permisos'
            ]
        ];

        $createdRoles = [];
        
        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ['name' => $roleData['name']],
                [
                    'display_name' => $roleData['display_name'],
                    'description' => $roleData['description']
                ]
            );
            $createdRoles[$roleData['name']] = $role;
        }

        // Crear permisos básicos
        $permissions = [
            [
                'name' => 'view_dashboard',
                'display_name' => 'Ver Dashboard',
                'description' => 'Puede ver el panel de control principal'
            ],
            [
                'name' => 'manage_users',
                'display_name' => 'Gestionar Usuarios',
                'description' => 'Puede crear, editar y eliminar usuarios'
            ],
            [
                'name' => 'manage_roles',
                'display_name' => 'Gestionar Roles',
                'description' => 'Puede crear, editar y eliminar roles'
            ],
            [
                'name' => 'manage_permissions',
                'display_name' => 'Gestionar Permisos',
                'description' => 'Puede crear, editar y eliminar permisos'
            ],
            [
                'name' => 'view_enrollment',
                'display_name' => 'Ver Matrículas',
                'description' => 'Puede ver las matrículas'
            ],
            [
                'name' => 'manage_enrollment',
                'display_name' => 'Gestionar Matrículas',
                'description' => 'Puede crear, editar y aprobar matrículas'
            ]
        ];

        // Crear los permisos y asignarlos
        foreach ($permissions as $permissionData) {
            $permission = Permission::firstOrCreate(
                ['name' => $permissionData['name']],
                [
                    'display_name' => $permissionData['display_name'],
                    'description' => $permissionData['description']
                ]
            );
            
            // Asignar a super_admin todos los permisos
            if (!$createdRoles['super_admin']->permissions()->where('permission_id', $permission->id)->exists()) {
                $createdRoles['super_admin']->permissions()->attach($permission->id);
            }
            
            // Asignar a admin todos menos manage_roles y manage_permissions
            if (!in_array($permissionData['name'], ['manage_roles', 'manage_permissions'])) {
                if (!$createdRoles['admin']->permissions()->where('permission_id', $permission->id)->exists()) {
                    $createdRoles['admin']->permissions()->attach($permission->id);
                }
            }
            
            // Asignar a user solo view_dashboard y view_enrollment
            if (in_array($permissionData['name'], ['view_dashboard', 'view_enrollment'])) {
                if (!$createdRoles['user']->permissions()->where('permission_id', $permission->id)->exists()) {
                    $createdRoles['user']->permissions()->attach($permission->id);
                }
            }
        }
    }
}
