<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'display_name' => 'Admin',
                'description' => 'test test',
                'guard_name' => 'web',
                'created_at' => '2021-06-18 02:09:22',
                'updated_at' => '2021-07-22 04:27:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Manager',
                'display_name' => 'Manager',
                'description' => 'Top Managemant',
                'guard_name' => 'web',
                'created_at' => '2021-06-30 02:37:55',
                'updated_at' => '2021-07-12 00:02:48',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ISD',
                'display_name' => 'Inside Sales Department',
                'description' => 'Inside Sales Department
',
                'guard_name' => 'web',
                'created_at' => '2021-06-30 05:42:28',
                'updated_at' => '2021-07-11 22:59:54',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'FSD',
                'display_name' => 'Field Sales Department',
                'description' => 'Field Sales Department
',
                'guard_name' => 'web',
                'created_at' => '2021-07-11 23:00:11',
                'updated_at' => '2021-07-22 04:54:37',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Control Form Approval Team',
                'display_name' => 'Control Form Approval Team',
                'description' => '',
                'guard_name' => 'web',
                'created_at' => '2021-07-22 04:54:55',
                'updated_at' => '2021-12-27 05:22:30',
            ),
        ));
        
        
    }
}