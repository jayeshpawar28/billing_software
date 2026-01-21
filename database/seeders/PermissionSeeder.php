<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Master module
            ['name' => 'master_access', 'display_name' => 'Master Access', 'module' => 'master', 'description' => 'Access to master data management'],
            ['name' => 'supplier_access', 'display_name' => 'Supplier Management', 'module' => 'master', 'description' => 'Manage suppliers'],
            ['name' => 'customer_access', 'display_name' => 'Customer Management', 'module' => 'master', 'description' => 'Manage customers'],
            
            // Product module
            ['name' => 'product_access', 'display_name' => 'Product Management', 'module' => 'product', 'description' => 'Manage products'],
            
            // Purchase module
            ['name' => 'purchase_access', 'display_name' => 'Purchase Management', 'module' => 'purchase', 'description' => 'Manage purchases'],
            
            // Stock module
            ['name' => 'stock_access', 'display_name' => 'Stock Management', 'module' => 'stock', 'description' => 'Manage stock'],
            
            // Sale module
            ['name' => 'sale_access', 'display_name' => 'Sale Management', 'module' => 'sale', 'description' => 'Manage sales'],
            
            // Report module
            ['name' => 'report_access', 'display_name' => 'Report Access', 'module' => 'report', 'description' => 'Access to reports'],
            
            // User Access module
            ['name' => 'user_access_management', 'display_name' => 'User Access Management', 'module' => 'user_access', 'description' => 'Manage user roles and permissions'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create default roles
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Full access to all features',
            'status' => 'active'
        ]);

        $managerRole = Role::create([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'Access to most features except user management',
            'status' => 'active'
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'Basic access to sales and reports',
            'status' => 'active'
        ]);

        // Assign permissions to roles
        $adminRole->permissions()->sync(Permission::pluck('id'));
        
        $managerRole->permissions()->sync(Permission::whereNotIn('name', ['user_access_management'])->pluck('id'));
        
        $userRole->permissions()->sync(Permission::whereIn('name', [
            'sale_access', 
            'report_access', 
            'product_access'
        ])->pluck('id'));
    }
}
