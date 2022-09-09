<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            4 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            7 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            9 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            10 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            11 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            12 => 
            array (
                'permission_id' => 9,
                'role_id' => 1,
            ),
            13 => 
            array (
                'permission_id' => 10,
                'role_id' => 1,
            ),
            14 => 
            array (
                'permission_id' => 11,
                'role_id' => 1,
            ),
            15 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            16 => 
            array (
                'permission_id' => 13,
                'role_id' => 1,
            ),
            17 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            18 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            19 => 
            array (
                'permission_id' => 15,
                'role_id' => 1,
            ),
            20 => 
            array (
                'permission_id' => 16,
                'role_id' => 1,
            ),
            21 => 
            array (
                'permission_id' => 17,
                'role_id' => 1,
            ),
            22 => 
            array (
                'permission_id' => 18,
                'role_id' => 1,
            ),
            23 => 
            array (
                'permission_id' => 19,
                'role_id' => 1,
            ),
            24 => 
            array (
                'permission_id' => 20,
                'role_id' => 1,
            ),
            25 => 
            array (
                'permission_id' => 21,
                'role_id' => 1,
            ),
            26 => 
            array (
                'permission_id' => 22,
                'role_id' => 1,
            ),
            27 => 
            array (
                'permission_id' => 23,
                'role_id' => 1,
            ),
            28 => 
            array (
                'permission_id' => 23,
                'role_id' => 2,
            ),
            29 => 
            array (
                'permission_id' => 23,
                'role_id' => 3,
            ),
            30 => 
            array (
                'permission_id' => 23,
                'role_id' => 4,
            ),
            31 => 
            array (
                'permission_id' => 24,
                'role_id' => 1,
            ),
            32 => 
            array (
                'permission_id' => 24,
                'role_id' => 2,
            ),
            33 => 
            array (
                'permission_id' => 25,
                'role_id' => 1,
            ),
            34 => 
            array (
                'permission_id' => 25,
                'role_id' => 2,
            ),
            35 => 
            array (
                'permission_id' => 26,
                'role_id' => 1,
            ),
            36 => 
            array (
                'permission_id' => 26,
                'role_id' => 2,
            ),
            37 => 
            array (
                'permission_id' => 26,
                'role_id' => 3,
            ),
            38 => 
            array (
                'permission_id' => 26,
                'role_id' => 4,
            ),
            39 => 
            array (
                'permission_id' => 27,
                'role_id' => 2,
            ),
            40 => 
            array (
                'permission_id' => 27,
                'role_id' => 5,
            ),
            41 => 
            array (
                'permission_id' => 29,
                'role_id' => 1,
            ),
            42 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            44 => 
            array (
                'permission_id' => 30,
                'role_id' => 5,
            ),
            45 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            46 => 
            array (
                'permission_id' => 31,
                'role_id' => 5,
            ),
            47 => 
            array (
                'permission_id' => 32,
                'role_id' => 2,
            ),
            48 => 
            array (
                'permission_id' => 32,
                'role_id' => 5,
            ),
            49 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            50 => 
            array (
                'permission_id' => 33,
                'role_id' => 5,
            ),
        ));
        
        
    }
}