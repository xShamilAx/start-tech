<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'Sonic Kolla',
                'permission_type' => 'R',
                'first_name' => 'Shamila',
                'last_name' => 'Fernando',
                'email' => 'Shamila.e.c.f@gmail.com',
                'phone_no' => '0527103606',
                'theme' => 'L',
                'password' => '$2y$10$RPJnQ68epsys26gCixTzNefjmiKUNwDr.lVtb3vx0dWc4IgCP9b6C',
                'status' => '1',
                'email_verified_at' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2021-05-31 18:30:00',
                'updated_at' => '2022-09-09 00:49:00',
            ),
            1 => 
            array (
                'id' => 5,
                'username' => 'User 123',
                'permission_type' => 'R',
                'first_name' => 'Test 133',
                'last_name' => '123 test',
                'email' => 'shamilafernandoe@gmail.com',
                'phone_no' => '0527103607',
                'theme' => 'L',
                'password' => '$2y$10$SoH5HVsI1kjgmGa8YI9Rw.32uyT2Nhp9SKL/q4cpT5Le454kaYarq',
                'status' => '1',
                'email_verified_at' => NULL,
                'created_by' => 1,
                'updated_by' => 5,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-09-08 18:14:13',
                'updated_at' => '2022-09-09 00:36:46',
            ),
            2 => 
            array (
                'id' => 6,
                'username' => 'sd',
                'permission_type' => 'R',
                'first_name' => 'sd',
                'last_name' => 'sd',
                'email' => 'sdd@sd.d',
                'phone_no' => 'sd',
                'theme' => 'L',
                'password' => '$2y$10$lJYAYuHzVPEMGg/a39MjK.02qUj8q9/VFDG3.1VA77CRJtge0B7Cy',
                'status' => '1',
                'email_verified_at' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-09-08 23:45:25',
                'updated_at' => '2022-09-08 23:45:25',
            ),
            3 => 
            array (
                'id' => 7,
                'username' => 'User',
                'permission_type' => 'R',
                'first_name' => 'Test',
                'last_name' => '123',
                'email' => 'shamilsafernandoe@gmail.com',
                'phone_no' => '052d71s03607',
                'theme' => 'L',
                'password' => '$2y$10$MC9ErR8F7p4tSwIRLMyLdOQBIMyMSEico85lrGVXeMFFaI47fs6xO',
                'status' => '1',
                'email_verified_at' => NULL,
                'created_by' => 0,
                'updated_by' => 0,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-09-08 23:46:31',
                'updated_at' => '2022-09-08 23:46:31',
            ),
            4 => 
            array (
                'id' => 8,
                'username' => 'Usser',
                'permission_type' => 'R',
                'first_name' => 'Test',
                'last_name' => '123',
                'email' => 'shamdilsafernandoe@gmail.com',
                'phone_no' => '052d71s033607',
                'theme' => 'L',
                'password' => '$2y$10$zSXxMZMj59d8F7h9FLtWauw8xQ/KBxds7tSCM4tQdqzEOMS69K1jW',
                'status' => '1',
                'email_verified_at' => NULL,
                'created_by' => 0,
                'updated_by' => 0,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-09-08 23:47:38',
                'updated_at' => '2022-09-08 23:47:38',
            ),
        ));
        
        
    }
}