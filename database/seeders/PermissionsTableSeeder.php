<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'MANAGE_USERS',
                'description' => 'MANAGE_USERS',
                'display_name' => 'Manage users',
                'guard_name' => 'web',
                'parent_id' => 13,
                'created_at' => '2022-09-07 19:49:22',
                'updated_at' => '2022-09-07 22:49:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ADD_USER',
                'description' => 'ADD_USER',
                'display_name' => 'Add user',
                'guard_name' => 'web',
                'parent_id' => 1,
                'created_at' => '2022-09-07 19:50:14',
                'updated_at' => '2022-09-07 19:50:14',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'EDIT_USER',
                'description' => 'EDIT_USER',
                'display_name' => 'Edit user',
                'guard_name' => 'web',
                'parent_id' => 1,
                'created_at' => '2022-09-07 19:50:38',
                'updated_at' => '2022-09-07 19:50:38',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'DELETE_USER',
                'description' => 'DELETE_USER',
                'display_name' => 'Delete user',
                'guard_name' => 'web',
                'parent_id' => 1,
                'created_at' => '2022-09-07 19:50:54',
                'updated_at' => '2022-09-07 19:50:54',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'MANAGE_PERMISSIONS',
                'description' => 'MANAGE_PERMISSIONS',
                'display_name' => 'Manage permissions',
                'guard_name' => 'web',
                'parent_id' => 13,
                'created_at' => '2022-09-07 20:28:18',
                'updated_at' => '2022-09-07 22:49:30',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'ADD_PERMISSION',
                'description' => 'ADD_PERMISSION',
                'display_name' => 'Add permission',
                'guard_name' => 'web',
                'parent_id' => 5,
                'created_at' => '2022-09-07 20:28:39',
                'updated_at' => '2022-09-07 20:28:39',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'EDIT_PERMISSION',
                'description' => 'EDIT_PERMISSION',
                'display_name' => 'Edit permission',
                'guard_name' => 'web',
                'parent_id' => 5,
                'created_at' => '2022-09-07 20:29:00',
                'updated_at' => '2022-09-07 20:29:00',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'DELETE_PERMISSION',
                'description' => 'DELETE_PERMISSION',
                'display_name' => 'Delete permission',
                'guard_name' => 'web',
                'parent_id' => 5,
                'created_at' => '2022-09-07 20:29:15',
                'updated_at' => '2022-09-07 20:29:15',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'MANAGE_ROLES',
                'description' => 'MANAGE_ROLES',
                'display_name' => 'Manage roles',
                'guard_name' => 'web',
                'parent_id' => 13,
                'created_at' => '2022-09-07 20:30:24',
                'updated_at' => '2022-09-07 22:49:38',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'ADD_ROLE',
                'description' => 'ADD_ROLE',
                'display_name' => 'Add role',
                'guard_name' => 'web',
                'parent_id' => 9,
                'created_at' => '2022-09-07 20:30:37',
                'updated_at' => '2022-09-07 20:30:37',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'EDIT_ROLE',
                'description' => 'EDIT_ROLE',
                'display_name' => 'Edit role',
                'guard_name' => 'web',
                'parent_id' => 9,
                'created_at' => '2022-09-07 20:31:08',
                'updated_at' => '2022-09-07 20:31:08',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'DELETE_ROLE',
                'description' => 'DELETE_ROLE',
                'display_name' => 'Delete role',
                'guard_name' => 'web',
                'parent_id' => 9,
                'created_at' => '2022-09-07 20:31:29',
                'updated_at' => '2022-09-07 20:31:29',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'MANAGE_SETTINGS',
                'description' => 'MANAGE_SETTINGS',
                'display_name' => 'Manage settings',
                'guard_name' => 'web',
                'parent_id' => 0,
                'created_at' => '2022-09-07 22:48:22',
                'updated_at' => '2022-09-07 22:48:22',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'MANAGE_PRODUCT',
                'description' => 'MANAGE_PRODUCT',
                'display_name' => 'Manage product',
                'guard_name' => 'web',
                'parent_id' => 0,
                'created_at' => '2022-09-08 10:07:02',
                'updated_at' => '2022-09-08 10:07:02',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'ADD_PRODUCT',
                'description' => 'ADD_PRODUCT',
                'display_name' => 'Add product',
                'guard_name' => 'web',
                'parent_id' => 14,
                'created_at' => '2022-09-08 10:07:26',
                'updated_at' => '2022-09-08 10:07:26',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'EDIT_PRODUCT',
                'description' => 'EDIT_PRODUCT',
                'display_name' => 'Edit product',
                'guard_name' => 'web',
                'parent_id' => 14,
                'created_at' => '2022-09-08 10:07:40',
                'updated_at' => '2022-09-08 10:07:40',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'DELETE_PRODUCT',
                'description' => 'DELETE_PEODUCT',
                'display_name' => 'Delete product',
                'guard_name' => 'web',
                'parent_id' => 14,
                'created_at' => '2022-09-08 10:08:00',
                'updated_at' => '2022-09-08 10:10:18',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'ASSIGN_PRODUCT',
                'description' => 'ASSIGN_PRODUCT',
                'display_name' => 'Assign product',
                'guard_name' => 'web',
                'parent_id' => 14,
                'created_at' => '2022-09-08 10:08:36',
                'updated_at' => '2022-09-08 10:08:36',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'REMOVE_UPLOADED_PRODUCT_IMAGE',
                'description' => '',
                'display_name' => 'Remove uploaded product image',
                'guard_name' => 'web',
                'parent_id' => 14,
                'created_at' => '2022-09-09 03:52:04',
                'updated_at' => '2022-09-09 03:52:04',
            ),
        ));
        
        
    }
}