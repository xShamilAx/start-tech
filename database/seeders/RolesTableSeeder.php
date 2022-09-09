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
                'description' => 'Admin Can Do',
                'guard_name' => 'web',
                'created_at' => '2022-09-07 20:32:22',
                'updated_at' => '2022-09-07 22:47:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'User',
                'display_name' => 'User',
                'description' => '',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 10:09:58',
                'updated_at' => '2022-09-08 10:09:58',
            ),
        ));
        
        
    }
}