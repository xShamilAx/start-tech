<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('configurations')->delete();

        \DB::table('configurations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'test',
                'display_name' => 'test',
                'config_type' => 'DD',
                'options' => NULL,
                'default_value' => NULL,
                'value' => '234',
                'options_array' => '"{\\"123\\":\\"123\\",\\"234\\":\\"234\\",\\"345\\":\\"345\\"}"',
                'category_id' => 1,
                'status' => '1',
                'hidden' => '0',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2021-05-31 05:27:14',
                'updated_at' => '2021-05-31 05:27:14',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'COMPANY_DETAILS',
                'display_name' => 'COMPANY_DETAILS',
                'config_type' => 'DD',
                'options' => NULL,
                'default_value' => NULL,
                'value' => '',
                'options_array' => '"{\\"_token\\":\\"7eFSnhZ6aBD3AXqE35PLYkoSWUvJ5pjr1VW6N4Eh\\",\\"ref_id\\":\\"\\",\\"media_type\\":\\"test\\",\\"media_ids\\":\\"5\\",\\"company_name\\":\\"Admin\\",\\"mobile\\":\\"+94702700948\\",\\"telephone\\":\\"+94112700948\\",\\"email\\":\\"Shamila.e.c.f@gmail.com\\",\\"website\\":\\"\\",\\"street1\\":\\"No:57\\\\\\/5 Gemunumawatha\\",\\"street2\\":\\"Hunupitiya\\",\\"city\\":\\"Wattala\\",\\"country\\":\\"Sri Lanka\\"}"',
                'category_id' => 1,
                'status' => '1',
                'hidden' => '0',
                'created_by' => 1,
                'updated_by' => 2,
                'deleted_at' => NULL,
                'created_at' => '2021-06-15 23:58:00',
                'updated_at' => '2021-06-30 05:35:48',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'MEDIA_TYPES',
                'display_name' => 'MEDIA_TYPES',
                'config_type' => 'DD',
                'options' => NULL,
                'default_value' => NULL,
                'value' => '',
                'options_array' => '"{\\"company_logo\\":\\"test\\",\\"product_logo\\":\\"product_logo\\"}"',
                'category_id' => 1,
                'status' => '1',
                'hidden' => '0',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
                'created_at' => '2021-06-30 05:11:16',
                'updated_at' => '2021-06-30 05:13:16',
            ),
        ));


    }
}
