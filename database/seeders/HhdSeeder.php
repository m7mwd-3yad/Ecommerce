<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HhdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
                // Dashboard
            ['name' => 'View Dashboard', 'group_name' => 'Dashboard'],

                // Category
            ['name' => 'View Categories', 'group_name' => 'Category'],
            ['name' => 'Create Category', 'group_name' => 'Category'],
            ['name' => 'Edit Category', 'group_name' => 'Category'],
            ['name' => 'Delete Category', 'group_name' => 'Category'],

                // Sub Category
            ['name' => 'View Sub Categories', 'group_name' => 'Sub Category'],
            ['name' => 'Create Sub Category', 'group_name' => 'Sub Category'],
            ['name' => 'Edit Sub Category', 'group_name' => 'Sub Category'],
            ['name' => 'Delete Sub Category', 'group_name' => 'Sub Category'],

                // Brands
            ['name' => 'View Brands', 'group_name' => 'Brands'],
            ['name' => 'Create Brand', 'group_name' => 'Brands'],
            ['name' => 'Edit Brand', 'group_name' => 'Brands'],
            ['name' => 'Delete Brand', 'group_name' => 'Brands'],

                // Products
            ['name' => 'View Products', 'group_name' => 'Products'],
            ['name' => 'Create Product', 'group_name' => 'Products'],
            ['name' => 'Edit Product', 'group_name' => 'Products'],
            ['name' => 'Delete Product', 'group_name' => 'Products'],

                // Shipping
            ['name' => 'View Shipping', 'group_name' => 'Shipping'],
            ['name' => 'Create Shipping', 'group_name' => 'Shipping'],
            ['name' => 'Edit Shipping', 'group_name' => 'Shipping'],
            ['name' => 'Delete Shipping', 'group_name' => 'Shipping'],

                // Orders
            ['name' => 'View Orders', 'group_name' => 'Orders'],
            ['name' => 'Create Order', 'group_name' => 'Orders'],
            ['name' => 'Edit Order', 'group_name' => 'Orders'],
            ['name' => 'Delete Order', 'group_name' => 'Orders'],

                // Permissions
            ['name' => 'View Permissions', 'group_name' => 'Permissions'],
            ['name' => 'Create Permission', 'group_name' => 'Permissions'],
            ['name' => 'Edit Permission', 'group_name' => 'Permissions'],
            ['name' => 'Delete Permission', 'group_name' => 'Permissions'],

                // Users
            ['name' => 'View Users', 'group_name' => 'Users'],
            ['name' => 'Create User', 'group_name' => 'Users'],
            ['name' => 'Edit User', 'group_name' => 'Users'],
            ['name' => 'Delete User', 'group_name' => 'Users'],

                // Pages
            ['name' => 'View Pages', 'group_name' => 'Pages'],
            ['name' => 'Create Page', 'group_name' => 'Pages'],
            ['name' => 'Edit Page', 'group_name' => 'Pages'],
            ['name' => 'Delete Page', 'group_name' => 'Pages'],

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'group_name' => $permission['group_name'],
            ]);
        }
    }
}

