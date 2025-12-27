<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OtpCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('otp_codes')->delete();
        
        \DB::table('otp_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'phone' => '5423024234',
                'code' => '277845',
                'user_id' => 2,
                'expires_at' => '2025-12-22 19:15:36',
                'used' => 1,
                'created_at' => '2025-12-22 19:05:36',
                'updated_at' => '2025-12-22 19:05:36',
            ),
            1 => 
            array (
                'id' => 2,
                'phone' => '5469251253',
                'code' => '431916',
                'user_id' => 3,
                'expires_at' => '2025-12-22 19:17:21',
                'used' => 1,
                'created_at' => '2025-12-22 19:07:21',
                'updated_at' => '2025-12-22 19:07:21',
            ),
            2 => 
            array (
                'id' => 3,
                'phone' => '5423024234',
                'code' => '603841',
                'user_id' => 3,
                'expires_at' => '2025-12-24 18:45:18',
                'used' => 1,
                'created_at' => '2025-12-24 18:35:18',
                'updated_at' => '2025-12-24 18:35:18',
            ),
            3 => 
            array (
                'id' => 4,
                'phone' => '5423024234',
                'code' => '631542',
                'user_id' => 3,
                'expires_at' => '2025-12-24 18:45:45',
                'used' => 1,
                'created_at' => '2025-12-24 18:35:45',
                'updated_at' => '2025-12-24 18:35:45',
            ),
            4 => 
            array (
                'id' => 5,
                'phone' => '5423024234',
                'code' => '043101',
                'user_id' => 2,
                'expires_at' => '2025-12-24 19:23:19',
                'used' => 1,
                'created_at' => '2025-12-24 19:13:19',
                'updated_at' => '2025-12-24 19:13:19',
            ),
            5 => 
            array (
                'id' => 6,
                'phone' => '5423024234',
                'code' => '763977',
                'user_id' => 14,
                'expires_at' => '2025-12-24 19:30:22',
                'used' => 1,
                'created_at' => '2025-12-24 19:20:22',
                'updated_at' => '2025-12-24 19:20:22',
            ),
            6 => 
            array (
                'id' => 7,
                'phone' => '5423024234',
                'code' => '338540',
                'user_id' => 14,
                'expires_at' => '2025-12-24 19:45:39',
                'used' => 1,
                'created_at' => '2025-12-24 19:35:39',
                'updated_at' => '2025-12-24 19:35:39',
            ),
            7 => 
            array (
                'id' => 8,
                'phone' => '5423024234',
                'code' => '144526',
                'user_id' => 14,
                'expires_at' => '2025-12-24 19:49:44',
                'used' => 1,
                'created_at' => '2025-12-24 19:39:44',
                'updated_at' => '2025-12-24 19:39:44',
            ),
            8 => 
            array (
                'id' => 9,
                'phone' => '5423024234',
                'code' => '015090',
                'user_id' => 14,
                'expires_at' => '2025-12-24 19:58:53',
                'used' => 1,
                'created_at' => '2025-12-24 19:48:53',
                'updated_at' => '2025-12-24 19:48:53',
            ),
            9 => 
            array (
                'id' => 10,
                'phone' => '5423024234',
                'code' => '451966',
                'user_id' => 14,
                'expires_at' => '2025-12-27 05:57:38',
                'used' => 1,
                'created_at' => '2025-12-27 05:47:38',
                'updated_at' => '2025-12-27 05:47:38',
            ),
        ));
        
        
    }
}