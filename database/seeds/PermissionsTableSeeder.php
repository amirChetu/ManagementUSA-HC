<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'permission_title' => 'Appointment Setting',
                'permission_slug' => 'appointment_setting',
                'permission_description' => 'Permission for Appointment Setting module.',
                'parent_id' => '0',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Read',
                'permission_slug' => 'appointment_setting_read',
                'permission_description' => 'Read permission for Appointment Setting module.',
                'parent_id' => '1',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Write',
                'permission_slug' => 'appointment_setting_write',
                'permission_description' => 'Write permission for Appointment Setting module.',
                'parent_id' => '1',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'POS',
                'permission_slug' => 'pos',
                'permission_description' => 'Permission for POS module.',
                'parent_id' => '0',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Read',
                'permission_slug' => 'pos_read',
                'permission_description' => 'Read permission for POS module.',
                'parent_id' => '4',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Write',
                'permission_slug' => 'pos_write',
                'permission_description' => 'Write permission for POS module.',
                'parent_id' => '4',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'ACL Management',
                'permission_slug' => 'acl_management',
                'permission_description' => 'Permission for ACL Management module.',
                'parent_id' => '0',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Read',
                'permission_slug' => 'acl_management_read',
                'permission_description' => 'Read permission for ACL Management module.',
                'parent_id' => '7',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Write',
                'permission_slug' => 'acl_management_write',
                'permission_description' => 'Write permission for ACL Management module.',
                'parent_id' => '7',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'User Management',
                'permission_slug' => 'user_management',
                'permission_description' => 'Permission for User Management module.',
                'parent_id' => '0',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Read',
                'permission_slug' => 'user_management_read',
                'permission_description' => 'Read permission for User Management module.',
                'parent_id' => '10',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Write',
                'permission_slug' => 'user_management_write',
                'permission_description' => 'Write permission for User Management module.',
                'parent_id' => '10',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Product Categories',
                'permission_slug' => 'product_categories',
                'permission_description' => 'Permission for Product Categories module.',
                'parent_id' => '0',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Read',
                'permission_slug' => 'product_categories_read',
                'permission_description' => 'Read permission for Product Categories module.',
                'parent_id' => '13',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Write',
                'permission_slug' => 'product_categories_write',
                'permission_description' => 'Write permission for Product Categories module.',
                'parent_id' => '13',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Product Imports',
                'permission_slug' => 'product_imports',
                'permission_description' => 'Permission for Product Imports module.',
                'parent_id' => '0',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Read',
                'permission_slug' => 'product_imports_read',
                'permission_description' => 'Read permission for Product Imports module.',
                'parent_id' => '16',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_title' => 'Write',
                'permission_slug' => 'product_imports_write',
                'permission_description' => 'Write permission for Product Imports module.',
                'parent_id' => '16',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}