<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
         $permissions = [
            'create product',
            'view product',
            'edit product',
            'delete product'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        // Create roles and assign permissions
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole->givePermissionTo(['edit product', 'delete product']);
        $adminRole->syncPermissions(Permission::all());

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // 👈 change password for security
                'email_verified_at' => now(),
            ]
        );
        
        $admin->assignRole($adminRole);

        foreach (User::where('email', '!=', 'admin@example.com')->get() as $user) {
            $user->assignRole('user');
        }

        // Optional: assign role to a specific user (e.g. with ID 1)
        // $user = User::find(1);
        // if ($user) {
        //    
        // }

    }
}
