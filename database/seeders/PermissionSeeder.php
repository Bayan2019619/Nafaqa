<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = ['view', 'create', 'edit', 'status', 'delete'];
        $features = ['user', 'profile_role', 'case'];

        $allPermissionNames = [];

        foreach ($features as $feature) {
            foreach ($permissions as $action) {
                $permissionName = "{$feature}.{$action}";
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                ]);
                $allPermissionNames[] = $permissionName;
            }
        }

   
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($allPermissionNames); 

        $admin = User::firstOrCreate(
            ['phone' => '0912444693'],
            [
                'name' => 'Murad AlBarki',
                'email' => 'pe.murad@gmail.com',
                'password' => bcrypt('@password'),
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        $user1 = User::firstOrCreate(
            ['phone' => '0954440744'],
            [
                'name' => 'Jhon doe',
                'email' => 'test@test.com',
                'password' => bcrypt('@password'),
            ]);

        $user1 = User::firstOrCreate(
            ['phone' => '0943383941'],
            [
                'name' => 'Arthur Morgan',
                'email' => 'arth@test.com',
                'password' => bcrypt('@password'),
            ]);
    
    }
}
