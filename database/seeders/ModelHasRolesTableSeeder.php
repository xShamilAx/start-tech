<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_has_roles')->delete();
        
        \DB::table('model_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 19,
            ),
            2 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 2,
            ),
            3 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 18,
            ),
            4 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 19,
            ),
            5 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 3,
            ),
            6 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 4,
            ),
            7 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 7,
            ),
            8 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 10,
            ),
            9 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 11,
            ),
            10 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 13,
            ),
            11 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 16,
            ),
            12 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 17,
            ),
            13 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 5,
            ),
            14 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 6,
            ),
            15 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 8,
            ),
            16 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 9,
            ),
            17 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 12,
            ),
            18 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 14,
            ),
            19 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 15,
            ),
            20 => 
            array (
                'role_id' => 5,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 1,
            ),
            21 => 
            array (
                'role_id' => 5,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 18,
            ),
            22 => 
            array (
                'role_id' => 5,
                'model_type' => 'App\\Models\\UserModel',
                'model_id' => 19,
            ),
        ));
        
        
    }
}