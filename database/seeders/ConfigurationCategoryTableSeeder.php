<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigurationCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('configuration_category')->delete();
        
        \DB::table('configuration_category')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'General',
                'description' => 'General Config Category',
                'status' => '1',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2021-05-30 22:57:26',
                'updated_at' => '2021-06-28 01:46:59',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'test',
                'description' => 'test',
                'status' => '1',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2021-12-22 11:29:15',
                'updated_at' => '2021-12-22 11:29:23',
            ),
        ));
        
        
    }
}