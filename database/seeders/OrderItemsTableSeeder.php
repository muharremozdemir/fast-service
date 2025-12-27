<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_items')->delete();
        
        \DB::table('order_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 5,
                'price' => '200.00',
                'created_at' => '2025-12-15 03:42:42',
                'updated_at' => '2025-12-15 03:42:42',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 1,
                'product_id' => 4,
                'quantity' => 4,
                'price' => '25.00',
                'created_at' => '2025-12-15 03:42:42',
                'updated_at' => '2025-12-15 03:42:42',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 1,
                'product_id' => 14,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-15 03:42:42',
                'updated_at' => '2025-12-15 03:42:42',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 1,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 03:42:42',
                'updated_at' => '2025-12-15 03:42:42',
            ),
            4 => 
            array (
                'id' => 5,
                'order_id' => 2,
                'product_id' => 1,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-10-22 05:00:42',
                'updated_at' => '2025-10-22 05:00:42',
            ),
            5 => 
            array (
                'id' => 6,
                'order_id' => 2,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-10-22 05:00:42',
                'updated_at' => '2025-10-22 05:00:42',
            ),
            6 => 
            array (
                'id' => 7,
                'order_id' => 2,
                'product_id' => 9,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-10-22 05:00:42',
                'updated_at' => '2025-10-22 05:00:42',
            ),
            7 => 
            array (
                'id' => 8,
                'order_id' => 2,
                'product_id' => 16,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-10-22 05:00:42',
                'updated_at' => '2025-10-22 05:00:42',
            ),
            8 => 
            array (
                'id' => 9,
                'order_id' => 3,
                'product_id' => 6,
                'quantity' => 2,
                'price' => '100.00',
                'created_at' => '2025-12-14 04:03:42',
                'updated_at' => '2025-12-14 04:03:42',
            ),
            9 => 
            array (
                'id' => 10,
                'order_id' => 3,
                'product_id' => 8,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-12-14 04:03:42',
                'updated_at' => '2025-12-14 04:03:42',
            ),
            10 => 
            array (
                'id' => 11,
                'order_id' => 3,
                'product_id' => 10,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-14 04:03:42',
                'updated_at' => '2025-12-14 04:03:42',
            ),
            11 => 
            array (
                'id' => 12,
                'order_id' => 3,
                'product_id' => 11,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-14 04:03:42',
                'updated_at' => '2025-12-14 04:03:42',
            ),
            12 => 
            array (
                'id' => 13,
                'order_id' => 3,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-14 04:03:42',
                'updated_at' => '2025-12-14 04:03:42',
            ),
            13 => 
            array (
                'id' => 14,
                'order_id' => 4,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-18 01:11:42',
                'updated_at' => '2025-12-18 01:11:42',
            ),
            14 => 
            array (
                'id' => 15,
                'order_id' => 4,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-18 01:11:42',
                'updated_at' => '2025-12-18 01:11:42',
            ),
            15 => 
            array (
                'id' => 16,
                'order_id' => 4,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-18 01:11:42',
                'updated_at' => '2025-12-18 01:11:42',
            ),
            16 => 
            array (
                'id' => 17,
                'order_id' => 4,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-18 01:11:42',
                'updated_at' => '2025-12-18 01:11:42',
            ),
            17 => 
            array (
                'id' => 18,
                'order_id' => 5,
                'product_id' => 4,
                'quantity' => 1,
                'price' => '25.00',
                'created_at' => '2025-12-07 07:26:42',
                'updated_at' => '2025-12-07 07:26:42',
            ),
            18 => 
            array (
                'id' => 19,
                'order_id' => 5,
                'product_id' => 15,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-07 07:26:42',
                'updated_at' => '2025-12-07 07:26:42',
            ),
            19 => 
            array (
                'id' => 20,
                'order_id' => 5,
                'product_id' => 16,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-07 07:26:42',
                'updated_at' => '2025-12-07 07:26:42',
            ),
            20 => 
            array (
                'id' => 21,
                'order_id' => 6,
                'product_id' => 14,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-15 22:24:42',
                'updated_at' => '2025-12-15 22:24:42',
            ),
            21 => 
            array (
                'id' => 22,
                'order_id' => 7,
                'product_id' => 14,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-17 04:14:42',
                'updated_at' => '2025-12-17 04:14:42',
            ),
            22 => 
            array (
                'id' => 23,
                'order_id' => 8,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-12-21 05:29:42',
                'updated_at' => '2025-12-21 05:29:42',
            ),
            23 => 
            array (
                'id' => 24,
                'order_id' => 8,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-21 05:29:42',
                'updated_at' => '2025-12-21 05:29:42',
            ),
            24 => 
            array (
                'id' => 25,
                'order_id' => 9,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:35:42',
                'updated_at' => '2025-12-14 22:35:42',
            ),
            25 => 
            array (
                'id' => 26,
                'order_id' => 10,
                'product_id' => 2,
                'quantity' => 2,
                'price' => '200.00',
                'created_at' => '2025-12-14 00:23:42',
                'updated_at' => '2025-12-14 00:23:42',
            ),
            26 => 
            array (
                'id' => 27,
                'order_id' => 10,
                'product_id' => 4,
                'quantity' => 1,
                'price' => '25.00',
                'created_at' => '2025-12-14 00:23:42',
                'updated_at' => '2025-12-14 00:23:42',
            ),
            27 => 
            array (
                'id' => 28,
                'order_id' => 11,
                'product_id' => 1,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-12-16 10:37:42',
                'updated_at' => '2025-12-16 10:37:42',
            ),
            28 => 
            array (
                'id' => 29,
                'order_id' => 11,
                'product_id' => 2,
                'quantity' => 5,
                'price' => '200.00',
                'created_at' => '2025-12-16 10:37:42',
                'updated_at' => '2025-12-16 10:37:42',
            ),
            29 => 
            array (
                'id' => 30,
                'order_id' => 11,
                'product_id' => 7,
                'quantity' => 1,
                'price' => '250.00',
                'created_at' => '2025-12-16 10:37:42',
                'updated_at' => '2025-12-16 10:37:42',
            ),
            30 => 
            array (
                'id' => 31,
                'order_id' => 12,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-20 23:33:42',
                'updated_at' => '2025-11-20 23:33:42',
            ),
            31 => 
            array (
                'id' => 32,
                'order_id' => 12,
                'product_id' => 11,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-11-20 23:33:42',
                'updated_at' => '2025-11-20 23:33:42',
            ),
            32 => 
            array (
                'id' => 33,
                'order_id' => 13,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-09-22 16:52:42',
                'updated_at' => '2025-09-22 16:52:42',
            ),
            33 => 
            array (
                'id' => 34,
                'order_id' => 13,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-09-22 16:52:42',
                'updated_at' => '2025-09-22 16:52:42',
            ),
            34 => 
            array (
                'id' => 35,
                'order_id' => 13,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-09-22 16:52:42',
                'updated_at' => '2025-09-22 16:52:42',
            ),
            35 => 
            array (
                'id' => 36,
                'order_id' => 13,
                'product_id' => 9,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-09-22 16:52:42',
                'updated_at' => '2025-09-22 16:52:42',
            ),
            36 => 
            array (
                'id' => 37,
                'order_id' => 14,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-15 01:34:42',
                'updated_at' => '2025-12-15 01:34:42',
            ),
            37 => 
            array (
                'id' => 38,
                'order_id' => 14,
                'product_id' => 8,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-12-15 01:34:42',
                'updated_at' => '2025-12-15 01:34:42',
            ),
            38 => 
            array (
                'id' => 39,
                'order_id' => 14,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 01:34:42',
                'updated_at' => '2025-12-15 01:34:42',
            ),
            39 => 
            array (
                'id' => 40,
                'order_id' => 15,
                'product_id' => 1,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-12-16 03:00:42',
                'updated_at' => '2025-12-16 03:00:42',
            ),
            40 => 
            array (
                'id' => 41,
                'order_id' => 15,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-16 03:00:42',
                'updated_at' => '2025-12-16 03:00:42',
            ),
            41 => 
            array (
                'id' => 42,
                'order_id' => 16,
                'product_id' => 1,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-15 21:01:42',
                'updated_at' => '2025-12-15 21:01:42',
            ),
            42 => 
            array (
                'id' => 43,
                'order_id' => 16,
                'product_id' => 5,
                'quantity' => 4,
                'price' => '50.00',
                'created_at' => '2025-12-15 21:01:42',
                'updated_at' => '2025-12-15 21:01:42',
            ),
            43 => 
            array (
                'id' => 44,
                'order_id' => 16,
                'product_id' => 13,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-15 21:01:42',
                'updated_at' => '2025-12-15 21:01:42',
            ),
            44 => 
            array (
                'id' => 45,
                'order_id' => 16,
                'product_id' => 14,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-15 21:01:42',
                'updated_at' => '2025-12-15 21:01:42',
            ),
            45 => 
            array (
                'id' => 46,
                'order_id' => 17,
                'product_id' => 3,
                'quantity' => 3,
                'price' => '30.00',
                'created_at' => '2025-12-18 18:49:42',
                'updated_at' => '2025-12-18 18:49:42',
            ),
            46 => 
            array (
                'id' => 47,
                'order_id' => 17,
                'product_id' => 6,
                'quantity' => 2,
                'price' => '100.00',
                'created_at' => '2025-12-18 18:49:42',
                'updated_at' => '2025-12-18 18:49:42',
            ),
            47 => 
            array (
                'id' => 48,
                'order_id' => 17,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-12-18 18:49:42',
                'updated_at' => '2025-12-18 18:49:42',
            ),
            48 => 
            array (
                'id' => 49,
                'order_id' => 17,
                'product_id' => 11,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-18 18:49:42',
                'updated_at' => '2025-12-18 18:49:42',
            ),
            49 => 
            array (
                'id' => 50,
                'order_id' => 17,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-18 18:49:42',
                'updated_at' => '2025-12-18 18:49:42',
            ),
            50 => 
            array (
                'id' => 51,
                'order_id' => 18,
                'product_id' => 7,
                'quantity' => 1,
                'price' => '250.00',
                'created_at' => '2025-12-19 11:30:42',
                'updated_at' => '2025-12-19 11:30:42',
            ),
            51 => 
            array (
                'id' => 52,
                'order_id' => 18,
                'product_id' => 12,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-19 11:30:42',
                'updated_at' => '2025-12-19 11:30:42',
            ),
            52 => 
            array (
                'id' => 53,
                'order_id' => 19,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-11-06 00:28:42',
                'updated_at' => '2025-11-06 00:28:42',
            ),
            53 => 
            array (
                'id' => 54,
                'order_id' => 20,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-09-22 04:19:42',
                'updated_at' => '2025-09-22 04:19:42',
            ),
            54 => 
            array (
                'id' => 55,
                'order_id' => 20,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-09-22 04:19:42',
                'updated_at' => '2025-09-22 04:19:42',
            ),
            55 => 
            array (
                'id' => 56,
                'order_id' => 21,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-12-19 21:39:42',
                'updated_at' => '2025-12-19 21:39:42',
            ),
            56 => 
            array (
                'id' => 57,
                'order_id' => 21,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-19 21:39:42',
                'updated_at' => '2025-12-19 21:39:42',
            ),
            57 => 
            array (
                'id' => 58,
                'order_id' => 21,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-12-19 21:39:42',
                'updated_at' => '2025-12-19 21:39:42',
            ),
            58 => 
            array (
                'id' => 59,
                'order_id' => 21,
                'product_id' => 15,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-19 21:39:42',
                'updated_at' => '2025-12-19 21:39:42',
            ),
            59 => 
            array (
                'id' => 60,
                'order_id' => 21,
                'product_id' => 16,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-19 21:39:42',
                'updated_at' => '2025-12-19 21:39:42',
            ),
            60 => 
            array (
                'id' => 61,
                'order_id' => 22,
                'product_id' => 1,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-11-30 15:26:42',
                'updated_at' => '2025-11-30 15:26:42',
            ),
            61 => 
            array (
                'id' => 62,
                'order_id' => 22,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-30 15:26:42',
                'updated_at' => '2025-11-30 15:26:42',
            ),
            62 => 
            array (
                'id' => 63,
                'order_id' => 23,
                'product_id' => 9,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-17 22:09:42',
                'updated_at' => '2025-12-17 22:09:42',
            ),
            63 => 
            array (
                'id' => 64,
                'order_id' => 23,
                'product_id' => 10,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-17 22:09:42',
                'updated_at' => '2025-12-17 22:09:42',
            ),
            64 => 
            array (
                'id' => 65,
                'order_id' => 24,
                'product_id' => 3,
                'quantity' => 2,
                'price' => '30.00',
                'created_at' => '2025-12-20 11:35:42',
                'updated_at' => '2025-12-20 11:35:42',
            ),
            65 => 
            array (
                'id' => 66,
                'order_id' => 25,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-21 07:30:42',
                'updated_at' => '2025-11-21 07:30:42',
            ),
            66 => 
            array (
                'id' => 67,
                'order_id' => 25,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-21 07:30:42',
                'updated_at' => '2025-11-21 07:30:42',
            ),
            67 => 
            array (
                'id' => 68,
                'order_id' => 26,
                'product_id' => 3,
                'quantity' => 2,
                'price' => '30.00',
                'created_at' => '2025-10-22 02:01:42',
                'updated_at' => '2025-10-22 02:01:42',
            ),
            68 => 
            array (
                'id' => 69,
                'order_id' => 27,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-12-21 02:09:42',
                'updated_at' => '2025-12-21 02:09:42',
            ),
            69 => 
            array (
                'id' => 70,
                'order_id' => 28,
                'product_id' => 9,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:49:42',
                'updated_at' => '2025-12-14 22:49:42',
            ),
            70 => 
            array (
                'id' => 71,
                'order_id' => 28,
                'product_id' => 12,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:49:42',
                'updated_at' => '2025-12-14 22:49:42',
            ),
            71 => 
            array (
                'id' => 72,
                'order_id' => 28,
                'product_id' => 13,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:49:42',
                'updated_at' => '2025-12-14 22:49:42',
            ),
            72 => 
            array (
                'id' => 73,
                'order_id' => 28,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:49:42',
                'updated_at' => '2025-12-14 22:49:42',
            ),
            73 => 
            array (
                'id' => 74,
                'order_id' => 29,
                'product_id' => 3,
                'quantity' => 3,
                'price' => '30.00',
                'created_at' => '2025-12-18 16:29:42',
                'updated_at' => '2025-12-18 16:29:42',
            ),
            74 => 
            array (
                'id' => 75,
                'order_id' => 29,
                'product_id' => 6,
                'quantity' => 5,
                'price' => '100.00',
                'created_at' => '2025-12-18 16:29:42',
                'updated_at' => '2025-12-18 16:29:42',
            ),
            75 => 
            array (
                'id' => 76,
                'order_id' => 29,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-12-18 16:29:42',
                'updated_at' => '2025-12-18 16:29:42',
            ),
            76 => 
            array (
                'id' => 77,
                'order_id' => 29,
                'product_id' => 14,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-18 16:29:42',
                'updated_at' => '2025-12-18 16:29:42',
            ),
            77 => 
            array (
                'id' => 78,
                'order_id' => 30,
                'product_id' => 3,
                'quantity' => 1,
                'price' => '30.00',
                'created_at' => '2025-09-22 08:36:42',
                'updated_at' => '2025-09-22 08:36:42',
            ),
            78 => 
            array (
                'id' => 79,
                'order_id' => 30,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-09-22 08:36:42',
                'updated_at' => '2025-09-22 08:36:42',
            ),
            79 => 
            array (
                'id' => 80,
                'order_id' => 30,
                'product_id' => 8,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-09-22 08:36:42',
                'updated_at' => '2025-09-22 08:36:42',
            ),
            80 => 
            array (
                'id' => 81,
                'order_id' => 30,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-09-22 08:36:42',
                'updated_at' => '2025-09-22 08:36:42',
            ),
            81 => 
            array (
                'id' => 82,
                'order_id' => 30,
                'product_id' => 11,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-09-22 08:36:42',
                'updated_at' => '2025-09-22 08:36:42',
            ),
            82 => 
            array (
                'id' => 83,
                'order_id' => 31,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-11-06 12:08:42',
                'updated_at' => '2025-11-06 12:08:42',
            ),
            83 => 
            array (
                'id' => 84,
                'order_id' => 31,
                'product_id' => 12,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-11-06 12:08:42',
                'updated_at' => '2025-11-06 12:08:42',
            ),
            84 => 
            array (
                'id' => 85,
                'order_id' => 31,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-06 12:08:42',
                'updated_at' => '2025-11-06 12:08:42',
            ),
            85 => 
            array (
                'id' => 86,
                'order_id' => 32,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-12-07 12:55:42',
                'updated_at' => '2025-12-07 12:55:42',
            ),
            86 => 
            array (
                'id' => 87,
                'order_id' => 32,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-12-07 12:55:42',
                'updated_at' => '2025-12-07 12:55:42',
            ),
            87 => 
            array (
                'id' => 88,
                'order_id' => 32,
                'product_id' => 11,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-07 12:55:42',
                'updated_at' => '2025-12-07 12:55:42',
            ),
            88 => 
            array (
                'id' => 89,
                'order_id' => 33,
                'product_id' => 11,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-11-30 04:35:42',
                'updated_at' => '2025-11-30 04:35:42',
            ),
            89 => 
            array (
                'id' => 90,
                'order_id' => 34,
                'product_id' => 5,
                'quantity' => 4,
                'price' => '50.00',
                'created_at' => '2025-11-06 08:41:42',
                'updated_at' => '2025-11-06 08:41:42',
            ),
            90 => 
            array (
                'id' => 91,
                'order_id' => 34,
                'product_id' => 9,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-11-06 08:41:42',
                'updated_at' => '2025-11-06 08:41:42',
            ),
            91 => 
            array (
                'id' => 92,
                'order_id' => 34,
                'product_id' => 13,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-06 08:41:42',
                'updated_at' => '2025-11-06 08:41:42',
            ),
            92 => 
            array (
                'id' => 93,
                'order_id' => 35,
                'product_id' => 4,
                'quantity' => 1,
                'price' => '25.00',
                'created_at' => '2025-12-20 10:46:43',
                'updated_at' => '2025-12-20 10:46:43',
            ),
            93 => 
            array (
                'id' => 94,
                'order_id' => 35,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-20 10:46:43',
                'updated_at' => '2025-12-20 10:46:43',
            ),
            94 => 
            array (
                'id' => 95,
                'order_id' => 35,
                'product_id' => 7,
                'quantity' => 1,
                'price' => '250.00',
                'created_at' => '2025-12-20 10:46:43',
                'updated_at' => '2025-12-20 10:46:43',
            ),
            95 => 
            array (
                'id' => 96,
                'order_id' => 35,
                'product_id' => 10,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-20 10:46:43',
                'updated_at' => '2025-12-20 10:46:43',
            ),
            96 => 
            array (
                'id' => 97,
                'order_id' => 36,
                'product_id' => 3,
                'quantity' => 5,
                'price' => '30.00',
                'created_at' => '2025-11-30 13:08:43',
                'updated_at' => '2025-11-30 13:08:43',
            ),
            97 => 
            array (
                'id' => 98,
                'order_id' => 36,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-30 13:08:43',
                'updated_at' => '2025-11-30 13:08:43',
            ),
            98 => 
            array (
                'id' => 99,
                'order_id' => 37,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            99 => 
            array (
                'id' => 100,
                'order_id' => 37,
                'product_id' => 6,
                'quantity' => 5,
                'price' => '100.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            100 => 
            array (
                'id' => 101,
                'order_id' => 37,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            101 => 
            array (
                'id' => 102,
                'order_id' => 38,
                'product_id' => 11,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-19 21:35:43',
                'updated_at' => '2025-12-19 21:35:43',
            ),
            102 => 
            array (
                'id' => 103,
                'order_id' => 39,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-12-20 21:42:43',
                'updated_at' => '2025-12-20 21:42:43',
            ),
            103 => 
            array (
                'id' => 104,
                'order_id' => 39,
                'product_id' => 5,
                'quantity' => 1,
                'price' => '50.00',
                'created_at' => '2025-12-20 21:42:43',
                'updated_at' => '2025-12-20 21:42:43',
            ),
            104 => 
            array (
                'id' => 105,
                'order_id' => 39,
                'product_id' => 7,
                'quantity' => 1,
                'price' => '250.00',
                'created_at' => '2025-12-20 21:42:43',
                'updated_at' => '2025-12-20 21:42:43',
            ),
            105 => 
            array (
                'id' => 106,
                'order_id' => 39,
                'product_id' => 9,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-20 21:42:43',
                'updated_at' => '2025-12-20 21:42:43',
            ),
            106 => 
            array (
                'id' => 107,
                'order_id' => 39,
                'product_id' => 15,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-20 21:42:43',
                'updated_at' => '2025-12-20 21:42:43',
            ),
            107 => 
            array (
                'id' => 108,
                'order_id' => 40,
                'product_id' => 2,
                'quantity' => 3,
                'price' => '200.00',
                'created_at' => '2025-12-16 18:58:43',
                'updated_at' => '2025-12-16 18:58:43',
            ),
            108 => 
            array (
                'id' => 109,
                'order_id' => 40,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-12-16 18:58:43',
                'updated_at' => '2025-12-16 18:58:43',
            ),
            109 => 
            array (
                'id' => 110,
                'order_id' => 40,
                'product_id' => 8,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-12-16 18:58:43',
                'updated_at' => '2025-12-16 18:58:43',
            ),
            110 => 
            array (
                'id' => 111,
                'order_id' => 40,
                'product_id' => 11,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-16 18:58:43',
                'updated_at' => '2025-12-16 18:58:43',
            ),
            111 => 
            array (
                'id' => 112,
                'order_id' => 41,
                'product_id' => 8,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-12-18 17:25:43',
                'updated_at' => '2025-12-18 17:25:43',
            ),
            112 => 
            array (
                'id' => 113,
                'order_id' => 41,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-18 17:25:43',
                'updated_at' => '2025-12-18 17:25:43',
            ),
            113 => 
            array (
                'id' => 114,
                'order_id' => 41,
                'product_id' => 11,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-18 17:25:43',
                'updated_at' => '2025-12-18 17:25:43',
            ),
            114 => 
            array (
                'id' => 115,
                'order_id' => 41,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-18 17:25:43',
                'updated_at' => '2025-12-18 17:25:43',
            ),
            115 => 
            array (
                'id' => 116,
                'order_id' => 42,
                'product_id' => 7,
                'quantity' => 2,
                'price' => '250.00',
                'created_at' => '2025-12-13 21:00:43',
                'updated_at' => '2025-12-13 21:00:43',
            ),
            116 => 
            array (
                'id' => 117,
                'order_id' => 42,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:00:43',
                'updated_at' => '2025-12-13 21:00:43',
            ),
            117 => 
            array (
                'id' => 118,
                'order_id' => 42,
                'product_id' => 11,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:00:43',
                'updated_at' => '2025-12-13 21:00:43',
            ),
            118 => 
            array (
                'id' => 119,
                'order_id' => 42,
                'product_id' => 13,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:00:43',
                'updated_at' => '2025-12-13 21:00:43',
            ),
            119 => 
            array (
                'id' => 120,
                'order_id' => 42,
                'product_id' => 16,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:00:43',
                'updated_at' => '2025-12-13 21:00:43',
            ),
            120 => 
            array (
                'id' => 121,
                'order_id' => 43,
                'product_id' => 1,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-09-22 17:30:43',
                'updated_at' => '2025-09-22 17:30:43',
            ),
            121 => 
            array (
                'id' => 122,
                'order_id' => 43,
                'product_id' => 2,
                'quantity' => 2,
                'price' => '200.00',
                'created_at' => '2025-09-22 17:30:43',
                'updated_at' => '2025-09-22 17:30:43',
            ),
            122 => 
            array (
                'id' => 123,
                'order_id' => 44,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-09-22 02:37:43',
                'updated_at' => '2025-09-22 02:37:43',
            ),
            123 => 
            array (
                'id' => 124,
                'order_id' => 44,
                'product_id' => 3,
                'quantity' => 5,
                'price' => '30.00',
                'created_at' => '2025-09-22 02:37:43',
                'updated_at' => '2025-09-22 02:37:43',
            ),
            124 => 
            array (
                'id' => 125,
                'order_id' => 44,
                'product_id' => 12,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-09-22 02:37:43',
                'updated_at' => '2025-09-22 02:37:43',
            ),
            125 => 
            array (
                'id' => 126,
                'order_id' => 45,
                'product_id' => 9,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-13 22:43:43',
                'updated_at' => '2025-12-13 22:43:43',
            ),
            126 => 
            array (
                'id' => 127,
                'order_id' => 46,
                'product_id' => 3,
                'quantity' => 2,
                'price' => '30.00',
                'created_at' => '2025-11-21 14:36:43',
                'updated_at' => '2025-11-21 14:36:43',
            ),
            127 => 
            array (
                'id' => 128,
                'order_id' => 46,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-11-21 14:36:43',
                'updated_at' => '2025-11-21 14:36:43',
            ),
            128 => 
            array (
                'id' => 129,
                'order_id' => 46,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-21 14:36:43',
                'updated_at' => '2025-11-21 14:36:43',
            ),
            129 => 
            array (
                'id' => 130,
                'order_id' => 46,
                'product_id' => 11,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-11-21 14:36:43',
                'updated_at' => '2025-11-21 14:36:43',
            ),
            130 => 
            array (
                'id' => 131,
                'order_id' => 46,
                'product_id' => 13,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-21 14:36:43',
                'updated_at' => '2025-11-21 14:36:43',
            ),
            131 => 
            array (
                'id' => 132,
                'order_id' => 47,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-21 09:27:43',
                'updated_at' => '2025-11-21 09:27:43',
            ),
            132 => 
            array (
                'id' => 133,
                'order_id' => 47,
                'product_id' => 14,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-11-21 09:27:43',
                'updated_at' => '2025-11-21 09:27:43',
            ),
            133 => 
            array (
                'id' => 134,
                'order_id' => 48,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-07 04:39:43',
                'updated_at' => '2025-12-07 04:39:43',
            ),
            134 => 
            array (
                'id' => 135,
                'order_id' => 48,
                'product_id' => 5,
                'quantity' => 2,
                'price' => '50.00',
                'created_at' => '2025-12-07 04:39:43',
                'updated_at' => '2025-12-07 04:39:43',
            ),
            135 => 
            array (
                'id' => 136,
                'order_id' => 48,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-12-07 04:39:43',
                'updated_at' => '2025-12-07 04:39:43',
            ),
            136 => 
            array (
                'id' => 137,
                'order_id' => 48,
                'product_id' => 8,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-12-07 04:39:43',
                'updated_at' => '2025-12-07 04:39:43',
            ),
            137 => 
            array (
                'id' => 138,
                'order_id' => 48,
                'product_id' => 12,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-07 04:39:43',
                'updated_at' => '2025-12-07 04:39:43',
            ),
            138 => 
            array (
                'id' => 139,
                'order_id' => 49,
                'product_id' => 4,
                'quantity' => 4,
                'price' => '25.00',
                'created_at' => '2025-11-06 08:11:43',
                'updated_at' => '2025-11-06 08:11:43',
            ),
            139 => 
            array (
                'id' => 140,
                'order_id' => 49,
                'product_id' => 5,
                'quantity' => 2,
                'price' => '50.00',
                'created_at' => '2025-11-06 08:11:43',
                'updated_at' => '2025-11-06 08:11:43',
            ),
            140 => 
            array (
                'id' => 141,
                'order_id' => 49,
                'product_id' => 6,
                'quantity' => 5,
                'price' => '100.00',
                'created_at' => '2025-11-06 08:11:43',
                'updated_at' => '2025-11-06 08:11:43',
            ),
            141 => 
            array (
                'id' => 142,
                'order_id' => 49,
                'product_id' => 7,
                'quantity' => 2,
                'price' => '250.00',
                'created_at' => '2025-11-06 08:11:43',
                'updated_at' => '2025-11-06 08:11:43',
            ),
            142 => 
            array (
                'id' => 143,
                'order_id' => 49,
                'product_id' => 10,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-06 08:11:43',
                'updated_at' => '2025-11-06 08:11:43',
            ),
            143 => 
            array (
                'id' => 144,
                'order_id' => 50,
                'product_id' => 3,
                'quantity' => 5,
                'price' => '30.00',
                'created_at' => '2025-11-06 13:46:43',
                'updated_at' => '2025-11-06 13:46:43',
            ),
            144 => 
            array (
                'id' => 145,
                'order_id' => 50,
                'product_id' => 13,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-06 13:46:43',
                'updated_at' => '2025-11-06 13:46:43',
            ),
            145 => 
            array (
                'id' => 146,
                'order_id' => 51,
                'product_id' => 5,
                'quantity' => 1,
                'price' => '50.00',
                'created_at' => '2025-12-15 05:34:43',
                'updated_at' => '2025-12-15 05:34:43',
            ),
            146 => 
            array (
                'id' => 147,
                'order_id' => 52,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-10-22 03:55:43',
                'updated_at' => '2025-10-22 03:55:43',
            ),
            147 => 
            array (
                'id' => 148,
                'order_id' => 52,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-10-22 03:55:43',
                'updated_at' => '2025-10-22 03:55:43',
            ),
            148 => 
            array (
                'id' => 149,
                'order_id' => 52,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-10-22 03:55:43',
                'updated_at' => '2025-10-22 03:55:43',
            ),
            149 => 
            array (
                'id' => 150,
                'order_id' => 53,
                'product_id' => 1,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-12-13 21:46:43',
                'updated_at' => '2025-12-13 21:46:43',
            ),
            150 => 
            array (
                'id' => 151,
                'order_id' => 53,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-12-13 21:46:43',
                'updated_at' => '2025-12-13 21:46:43',
            ),
            151 => 
            array (
                'id' => 152,
                'order_id' => 54,
                'product_id' => 11,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-19 21:33:43',
                'updated_at' => '2025-12-19 21:33:43',
            ),
            152 => 
            array (
                'id' => 153,
                'order_id' => 55,
                'product_id' => 2,
                'quantity' => 3,
                'price' => '200.00',
                'created_at' => '2025-12-07 05:42:43',
                'updated_at' => '2025-12-07 05:42:43',
            ),
            153 => 
            array (
                'id' => 154,
                'order_id' => 55,
                'product_id' => 10,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-07 05:42:43',
                'updated_at' => '2025-12-07 05:42:43',
            ),
            154 => 
            array (
                'id' => 155,
                'order_id' => 56,
                'product_id' => 1,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-12-18 03:57:43',
                'updated_at' => '2025-12-18 03:57:43',
            ),
            155 => 
            array (
                'id' => 156,
                'order_id' => 56,
                'product_id' => 3,
                'quantity' => 3,
                'price' => '30.00',
                'created_at' => '2025-12-18 03:57:43',
                'updated_at' => '2025-12-18 03:57:43',
            ),
            156 => 
            array (
                'id' => 157,
                'order_id' => 56,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-12-18 03:57:43',
                'updated_at' => '2025-12-18 03:57:43',
            ),
            157 => 
            array (
                'id' => 158,
                'order_id' => 56,
                'product_id' => 13,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-18 03:57:43',
                'updated_at' => '2025-12-18 03:57:43',
            ),
            158 => 
            array (
                'id' => 159,
                'order_id' => 57,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-11-21 11:56:43',
                'updated_at' => '2025-11-21 11:56:43',
            ),
            159 => 
            array (
                'id' => 160,
                'order_id' => 57,
                'product_id' => 4,
                'quantity' => 4,
                'price' => '25.00',
                'created_at' => '2025-11-21 11:56:43',
                'updated_at' => '2025-11-21 11:56:43',
            ),
            160 => 
            array (
                'id' => 161,
                'order_id' => 57,
                'product_id' => 8,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-11-21 11:56:43',
                'updated_at' => '2025-11-21 11:56:43',
            ),
            161 => 
            array (
                'id' => 162,
                'order_id' => 57,
                'product_id' => 12,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-21 11:56:43',
                'updated_at' => '2025-11-21 11:56:43',
            ),
            162 => 
            array (
                'id' => 163,
                'order_id' => 57,
                'product_id' => 13,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-11-21 11:56:43',
                'updated_at' => '2025-11-21 11:56:43',
            ),
            163 => 
            array (
                'id' => 164,
                'order_id' => 58,
                'product_id' => 7,
                'quantity' => 2,
                'price' => '250.00',
                'created_at' => '2025-10-22 05:05:43',
                'updated_at' => '2025-10-22 05:05:43',
            ),
            164 => 
            array (
                'id' => 165,
                'order_id' => 59,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-09-22 05:48:43',
                'updated_at' => '2025-09-22 05:48:43',
            ),
            165 => 
            array (
                'id' => 166,
                'order_id' => 59,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-09-22 05:48:43',
                'updated_at' => '2025-09-22 05:48:43',
            ),
            166 => 
            array (
                'id' => 167,
                'order_id' => 59,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-09-22 05:48:43',
                'updated_at' => '2025-09-22 05:48:43',
            ),
            167 => 
            array (
                'id' => 168,
                'order_id' => 59,
                'product_id' => 14,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-09-22 05:48:43',
                'updated_at' => '2025-09-22 05:48:43',
            ),
            168 => 
            array (
                'id' => 169,
                'order_id' => 59,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-09-22 05:48:43',
                'updated_at' => '2025-09-22 05:48:43',
            ),
            169 => 
            array (
                'id' => 170,
                'order_id' => 60,
                'product_id' => 3,
                'quantity' => 5,
                'price' => '30.00',
                'created_at' => '2025-12-14 01:14:43',
                'updated_at' => '2025-12-14 01:14:43',
            ),
            170 => 
            array (
                'id' => 171,
                'order_id' => 60,
                'product_id' => 13,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-14 01:14:43',
                'updated_at' => '2025-12-14 01:14:43',
            ),
            171 => 
            array (
                'id' => 172,
                'order_id' => 61,
                'product_id' => 4,
                'quantity' => 2,
                'price' => '25.00',
                'created_at' => '2025-12-20 04:08:43',
                'updated_at' => '2025-12-20 04:08:43',
            ),
            172 => 
            array (
                'id' => 173,
                'order_id' => 61,
                'product_id' => 9,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-20 04:08:43',
                'updated_at' => '2025-12-20 04:08:43',
            ),
            173 => 
            array (
                'id' => 174,
                'order_id' => 61,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-20 04:08:43',
                'updated_at' => '2025-12-20 04:08:43',
            ),
            174 => 
            array (
                'id' => 175,
                'order_id' => 62,
                'product_id' => 3,
                'quantity' => 3,
                'price' => '30.00',
                'created_at' => '2025-11-06 05:42:43',
                'updated_at' => '2025-11-06 05:42:43',
            ),
            175 => 
            array (
                'id' => 176,
                'order_id' => 62,
                'product_id' => 4,
                'quantity' => 1,
                'price' => '25.00',
                'created_at' => '2025-11-06 05:42:43',
                'updated_at' => '2025-11-06 05:42:43',
            ),
            176 => 
            array (
                'id' => 177,
                'order_id' => 62,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-11-06 05:42:43',
                'updated_at' => '2025-11-06 05:42:43',
            ),
            177 => 
            array (
                'id' => 178,
                'order_id' => 62,
                'product_id' => 10,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-11-06 05:42:43',
                'updated_at' => '2025-11-06 05:42:43',
            ),
            178 => 
            array (
                'id' => 179,
                'order_id' => 62,
                'product_id' => 14,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-06 05:42:43',
                'updated_at' => '2025-11-06 05:42:43',
            ),
            179 => 
            array (
                'id' => 180,
                'order_id' => 63,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-12-20 07:35:43',
                'updated_at' => '2025-12-20 07:35:43',
            ),
            180 => 
            array (
                'id' => 181,
                'order_id' => 63,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-12-20 07:35:43',
                'updated_at' => '2025-12-20 07:35:43',
            ),
            181 => 
            array (
                'id' => 182,
                'order_id' => 63,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-20 07:35:43',
                'updated_at' => '2025-12-20 07:35:43',
            ),
            182 => 
            array (
                'id' => 183,
                'order_id' => 63,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-20 07:35:43',
                'updated_at' => '2025-12-20 07:35:43',
            ),
            183 => 
            array (
                'id' => 184,
                'order_id' => 63,
                'product_id' => 12,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-20 07:35:43',
                'updated_at' => '2025-12-20 07:35:43',
            ),
            184 => 
            array (
                'id' => 185,
                'order_id' => 64,
                'product_id' => 1,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-11-30 13:58:43',
                'updated_at' => '2025-11-30 13:58:43',
            ),
            185 => 
            array (
                'id' => 186,
                'order_id' => 64,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-11-30 13:58:43',
                'updated_at' => '2025-11-30 13:58:43',
            ),
            186 => 
            array (
                'id' => 187,
                'order_id' => 64,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-11-30 13:58:43',
                'updated_at' => '2025-11-30 13:58:43',
            ),
            187 => 
            array (
                'id' => 188,
                'order_id' => 64,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-30 13:58:43',
                'updated_at' => '2025-11-30 13:58:43',
            ),
            188 => 
            array (
                'id' => 189,
                'order_id' => 65,
                'product_id' => 5,
                'quantity' => 1,
                'price' => '50.00',
                'created_at' => '2025-11-05 20:07:43',
                'updated_at' => '2025-11-05 20:07:43',
            ),
            189 => 
            array (
                'id' => 190,
                'order_id' => 65,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-11-05 20:07:43',
                'updated_at' => '2025-11-05 20:07:43',
            ),
            190 => 
            array (
                'id' => 191,
                'order_id' => 65,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-11-05 20:07:43',
                'updated_at' => '2025-11-05 20:07:43',
            ),
            191 => 
            array (
                'id' => 192,
                'order_id' => 66,
                'product_id' => 16,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-17 22:44:43',
                'updated_at' => '2025-12-17 22:44:43',
            ),
            192 => 
            array (
                'id' => 193,
                'order_id' => 67,
                'product_id' => 1,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-11-06 10:19:43',
                'updated_at' => '2025-11-06 10:19:43',
            ),
            193 => 
            array (
                'id' => 194,
                'order_id' => 67,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-11-06 10:19:43',
                'updated_at' => '2025-11-06 10:19:43',
            ),
            194 => 
            array (
                'id' => 195,
                'order_id' => 67,
                'product_id' => 10,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-11-06 10:19:43',
                'updated_at' => '2025-11-06 10:19:43',
            ),
            195 => 
            array (
                'id' => 196,
                'order_id' => 67,
                'product_id' => 11,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-06 10:19:43',
                'updated_at' => '2025-11-06 10:19:43',
            ),
            196 => 
            array (
                'id' => 197,
                'order_id' => 67,
                'product_id' => 16,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-06 10:19:43',
                'updated_at' => '2025-11-06 10:19:43',
            ),
            197 => 
            array (
                'id' => 198,
                'order_id' => 68,
                'product_id' => 9,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-09-22 05:39:43',
                'updated_at' => '2025-09-22 05:39:43',
            ),
            198 => 
            array (
                'id' => 199,
                'order_id' => 68,
                'product_id' => 10,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-09-22 05:39:43',
                'updated_at' => '2025-09-22 05:39:43',
            ),
            199 => 
            array (
                'id' => 200,
                'order_id' => 69,
                'product_id' => 8,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-12-13 19:19:43',
                'updated_at' => '2025-12-13 19:19:43',
            ),
            200 => 
            array (
                'id' => 201,
                'order_id' => 70,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-12-18 03:26:43',
                'updated_at' => '2025-12-18 03:26:43',
            ),
            201 => 
            array (
                'id' => 202,
                'order_id' => 70,
                'product_id' => 16,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-18 03:26:43',
                'updated_at' => '2025-12-18 03:26:43',
            ),
            202 => 
            array (
                'id' => 203,
                'order_id' => 71,
                'product_id' => 2,
                'quantity' => 3,
                'price' => '200.00',
                'created_at' => '2025-12-19 14:57:43',
                'updated_at' => '2025-12-19 14:57:43',
            ),
            203 => 
            array (
                'id' => 204,
                'order_id' => 71,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-12-19 14:57:43',
                'updated_at' => '2025-12-19 14:57:43',
            ),
            204 => 
            array (
                'id' => 205,
                'order_id' => 71,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-12-19 14:57:43',
                'updated_at' => '2025-12-19 14:57:43',
            ),
            205 => 
            array (
                'id' => 206,
                'order_id' => 71,
                'product_id' => 11,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-19 14:57:43',
                'updated_at' => '2025-12-19 14:57:43',
            ),
            206 => 
            array (
                'id' => 207,
                'order_id' => 71,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-19 14:57:43',
                'updated_at' => '2025-12-19 14:57:43',
            ),
            207 => 
            array (
                'id' => 208,
                'order_id' => 72,
                'product_id' => 4,
                'quantity' => 4,
                'price' => '25.00',
                'created_at' => '2025-12-19 09:29:43',
                'updated_at' => '2025-12-19 09:29:43',
            ),
            208 => 
            array (
                'id' => 209,
                'order_id' => 72,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-19 09:29:43',
                'updated_at' => '2025-12-19 09:29:43',
            ),
            209 => 
            array (
                'id' => 210,
                'order_id' => 72,
                'product_id' => 10,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 09:29:43',
                'updated_at' => '2025-12-19 09:29:43',
            ),
            210 => 
            array (
                'id' => 211,
                'order_id' => 72,
                'product_id' => 11,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 09:29:43',
                'updated_at' => '2025-12-19 09:29:43',
            ),
            211 => 
            array (
                'id' => 212,
                'order_id' => 72,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 09:29:43',
                'updated_at' => '2025-12-19 09:29:43',
            ),
            212 => 
            array (
                'id' => 213,
                'order_id' => 73,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-09-21 18:23:43',
                'updated_at' => '2025-09-21 18:23:43',
            ),
            213 => 
            array (
                'id' => 214,
                'order_id' => 73,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-09-21 18:23:43',
                'updated_at' => '2025-09-21 18:23:43',
            ),
            214 => 
            array (
                'id' => 215,
                'order_id' => 73,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-09-21 18:23:43',
                'updated_at' => '2025-09-21 18:23:43',
            ),
            215 => 
            array (
                'id' => 216,
                'order_id' => 73,
                'product_id' => 11,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-09-21 18:23:43',
                'updated_at' => '2025-09-21 18:23:43',
            ),
            216 => 
            array (
                'id' => 217,
                'order_id' => 73,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-09-21 18:23:43',
                'updated_at' => '2025-09-21 18:23:43',
            ),
            217 => 
            array (
                'id' => 218,
                'order_id' => 74,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-12-18 20:29:43',
                'updated_at' => '2025-12-18 20:29:43',
            ),
            218 => 
            array (
                'id' => 219,
                'order_id' => 74,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-12-18 20:29:43',
                'updated_at' => '2025-12-18 20:29:43',
            ),
            219 => 
            array (
                'id' => 220,
                'order_id' => 74,
                'product_id' => 9,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-18 20:29:43',
                'updated_at' => '2025-12-18 20:29:43',
            ),
            220 => 
            array (
                'id' => 221,
                'order_id' => 75,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-30 08:56:43',
                'updated_at' => '2025-11-30 08:56:43',
            ),
            221 => 
            array (
                'id' => 222,
                'order_id' => 76,
                'product_id' => 1,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-10-22 17:52:43',
                'updated_at' => '2025-10-22 17:52:43',
            ),
            222 => 
            array (
                'id' => 223,
                'order_id' => 77,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-12-20 06:31:43',
                'updated_at' => '2025-12-20 06:31:43',
            ),
            223 => 
            array (
                'id' => 224,
                'order_id' => 77,
                'product_id' => 9,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-20 06:31:43',
                'updated_at' => '2025-12-20 06:31:43',
            ),
            224 => 
            array (
                'id' => 225,
                'order_id' => 77,
                'product_id' => 11,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-20 06:31:43',
                'updated_at' => '2025-12-20 06:31:43',
            ),
            225 => 
            array (
                'id' => 226,
                'order_id' => 77,
                'product_id' => 13,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-20 06:31:43',
                'updated_at' => '2025-12-20 06:31:43',
            ),
            226 => 
            array (
                'id' => 227,
                'order_id' => 77,
                'product_id' => 15,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-20 06:31:43',
                'updated_at' => '2025-12-20 06:31:43',
            ),
            227 => 
            array (
                'id' => 228,
                'order_id' => 78,
                'product_id' => 1,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-11-20 21:44:43',
                'updated_at' => '2025-11-20 21:44:43',
            ),
            228 => 
            array (
                'id' => 229,
                'order_id' => 78,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-11-20 21:44:43',
                'updated_at' => '2025-11-20 21:44:43',
            ),
            229 => 
            array (
                'id' => 230,
                'order_id' => 78,
                'product_id' => 6,
                'quantity' => 2,
                'price' => '100.00',
                'created_at' => '2025-11-20 21:44:43',
                'updated_at' => '2025-11-20 21:44:43',
            ),
            230 => 
            array (
                'id' => 231,
                'order_id' => 78,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-11-20 21:44:43',
                'updated_at' => '2025-11-20 21:44:43',
            ),
            231 => 
            array (
                'id' => 232,
                'order_id' => 79,
                'product_id' => 10,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:42:43',
                'updated_at' => '2025-12-13 21:42:43',
            ),
            232 => 
            array (
                'id' => 233,
                'order_id' => 79,
                'product_id' => 12,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:42:43',
                'updated_at' => '2025-12-13 21:42:43',
            ),
            233 => 
            array (
                'id' => 234,
                'order_id' => 79,
                'product_id' => 14,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-13 21:42:43',
                'updated_at' => '2025-12-13 21:42:43',
            ),
            234 => 
            array (
                'id' => 235,
                'order_id' => 80,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-16 13:32:43',
                'updated_at' => '2025-12-16 13:32:43',
            ),
            235 => 
            array (
                'id' => 236,
                'order_id' => 80,
                'product_id' => 7,
                'quantity' => 1,
                'price' => '250.00',
                'created_at' => '2025-12-16 13:32:43',
                'updated_at' => '2025-12-16 13:32:43',
            ),
            236 => 
            array (
                'id' => 237,
                'order_id' => 80,
                'product_id' => 9,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-16 13:32:43',
                'updated_at' => '2025-12-16 13:32:43',
            ),
            237 => 
            array (
                'id' => 238,
                'order_id' => 80,
                'product_id' => 15,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-16 13:32:43',
                'updated_at' => '2025-12-16 13:32:43',
            ),
            238 => 
            array (
                'id' => 239,
                'order_id' => 81,
                'product_id' => 1,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-12-18 13:50:43',
                'updated_at' => '2025-12-18 13:50:43',
            ),
            239 => 
            array (
                'id' => 240,
                'order_id' => 81,
                'product_id' => 3,
                'quantity' => 1,
                'price' => '30.00',
                'created_at' => '2025-12-18 13:50:43',
                'updated_at' => '2025-12-18 13:50:43',
            ),
            240 => 
            array (
                'id' => 241,
                'order_id' => 82,
                'product_id' => 3,
                'quantity' => 3,
                'price' => '30.00',
                'created_at' => '2025-11-05 21:11:43',
                'updated_at' => '2025-11-05 21:11:43',
            ),
            241 => 
            array (
                'id' => 242,
                'order_id' => 82,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-05 21:11:43',
                'updated_at' => '2025-11-05 21:11:43',
            ),
            242 => 
            array (
                'id' => 243,
                'order_id' => 83,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-07 00:11:43',
                'updated_at' => '2025-12-07 00:11:43',
            ),
            243 => 
            array (
                'id' => 244,
                'order_id' => 83,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-12-07 00:11:43',
                'updated_at' => '2025-12-07 00:11:43',
            ),
            244 => 
            array (
                'id' => 245,
                'order_id' => 83,
                'product_id' => 10,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-07 00:11:43',
                'updated_at' => '2025-12-07 00:11:43',
            ),
            245 => 
            array (
                'id' => 246,
                'order_id' => 83,
                'product_id' => 12,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-07 00:11:43',
                'updated_at' => '2025-12-07 00:11:43',
            ),
            246 => 
            array (
                'id' => 247,
                'order_id' => 83,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-07 00:11:43',
                'updated_at' => '2025-12-07 00:11:43',
            ),
            247 => 
            array (
                'id' => 248,
                'order_id' => 84,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-14 07:21:43',
                'updated_at' => '2025-12-14 07:21:43',
            ),
            248 => 
            array (
                'id' => 249,
                'order_id' => 84,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-14 07:21:43',
                'updated_at' => '2025-12-14 07:21:43',
            ),
            249 => 
            array (
                'id' => 250,
                'order_id' => 84,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-14 07:21:43',
                'updated_at' => '2025-12-14 07:21:43',
            ),
            250 => 
            array (
                'id' => 251,
                'order_id' => 85,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-12-15 12:20:43',
                'updated_at' => '2025-12-15 12:20:43',
            ),
            251 => 
            array (
                'id' => 252,
                'order_id' => 85,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-15 12:20:43',
                'updated_at' => '2025-12-15 12:20:43',
            ),
            252 => 
            array (
                'id' => 253,
                'order_id' => 85,
                'product_id' => 9,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 12:20:43',
                'updated_at' => '2025-12-15 12:20:43',
            ),
            253 => 
            array (
                'id' => 254,
                'order_id' => 85,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-15 12:20:43',
                'updated_at' => '2025-12-15 12:20:43',
            ),
            254 => 
            array (
                'id' => 255,
                'order_id' => 85,
                'product_id' => 16,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-15 12:20:43',
                'updated_at' => '2025-12-15 12:20:43',
            ),
            255 => 
            array (
                'id' => 256,
                'order_id' => 86,
                'product_id' => 14,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-16 00:19:43',
                'updated_at' => '2025-12-16 00:19:43',
            ),
            256 => 
            array (
                'id' => 257,
                'order_id' => 87,
                'product_id' => 12,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-21 03:19:43',
                'updated_at' => '2025-12-21 03:19:43',
            ),
            257 => 
            array (
                'id' => 258,
                'order_id' => 88,
                'product_id' => 13,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-10-21 23:42:43',
                'updated_at' => '2025-10-21 23:42:43',
            ),
            258 => 
            array (
                'id' => 259,
                'order_id' => 89,
                'product_id' => 2,
                'quantity' => 1,
                'price' => '200.00',
                'created_at' => '2025-12-15 16:59:43',
                'updated_at' => '2025-12-15 16:59:43',
            ),
            259 => 
            array (
                'id' => 260,
                'order_id' => 89,
                'product_id' => 3,
                'quantity' => 5,
                'price' => '30.00',
                'created_at' => '2025-12-15 16:59:43',
                'updated_at' => '2025-12-15 16:59:43',
            ),
            260 => 
            array (
                'id' => 261,
                'order_id' => 89,
                'product_id' => 5,
                'quantity' => 5,
                'price' => '50.00',
                'created_at' => '2025-12-15 16:59:43',
                'updated_at' => '2025-12-15 16:59:43',
            ),
            261 => 
            array (
                'id' => 262,
                'order_id' => 89,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-12-15 16:59:43',
                'updated_at' => '2025-12-15 16:59:43',
            ),
            262 => 
            array (
                'id' => 263,
                'order_id' => 90,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-12-17 06:50:43',
                'updated_at' => '2025-12-17 06:50:43',
            ),
            263 => 
            array (
                'id' => 264,
                'order_id' => 91,
                'product_id' => 1,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-10-21 19:03:43',
                'updated_at' => '2025-10-21 19:03:43',
            ),
            264 => 
            array (
                'id' => 265,
                'order_id' => 91,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-10-21 19:03:43',
                'updated_at' => '2025-10-21 19:03:43',
            ),
            265 => 
            array (
                'id' => 266,
                'order_id' => 92,
                'product_id' => 12,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-14 00:30:43',
                'updated_at' => '2025-12-14 00:30:43',
            ),
            266 => 
            array (
                'id' => 267,
                'order_id' => 93,
                'product_id' => 1,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-12-17 18:03:43',
                'updated_at' => '2025-12-17 18:03:43',
            ),
            267 => 
            array (
                'id' => 268,
                'order_id' => 93,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-12-17 18:03:43',
                'updated_at' => '2025-12-17 18:03:43',
            ),
            268 => 
            array (
                'id' => 269,
                'order_id' => 93,
                'product_id' => 15,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-17 18:03:43',
                'updated_at' => '2025-12-17 18:03:43',
            ),
            269 => 
            array (
                'id' => 270,
                'order_id' => 94,
                'product_id' => 10,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-20 18:50:43',
                'updated_at' => '2025-12-20 18:50:43',
            ),
            270 => 
            array (
                'id' => 271,
                'order_id' => 95,
                'product_id' => 1,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-11-20 18:54:43',
                'updated_at' => '2025-11-20 18:54:43',
            ),
            271 => 
            array (
                'id' => 272,
                'order_id' => 95,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-11-20 18:54:43',
                'updated_at' => '2025-11-20 18:54:43',
            ),
            272 => 
            array (
                'id' => 273,
                'order_id' => 95,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-11-20 18:54:43',
                'updated_at' => '2025-11-20 18:54:43',
            ),
            273 => 
            array (
                'id' => 274,
                'order_id' => 95,
                'product_id' => 11,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-20 18:54:43',
                'updated_at' => '2025-11-20 18:54:43',
            ),
            274 => 
            array (
                'id' => 275,
                'order_id' => 95,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-20 18:54:43',
                'updated_at' => '2025-11-20 18:54:43',
            ),
            275 => 
            array (
                'id' => 276,
                'order_id' => 96,
                'product_id' => 10,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-09-22 18:00:43',
                'updated_at' => '2025-09-22 18:00:43',
            ),
            276 => 
            array (
                'id' => 277,
                'order_id' => 97,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-12-17 17:29:43',
                'updated_at' => '2025-12-17 17:29:43',
            ),
            277 => 
            array (
                'id' => 278,
                'order_id' => 97,
                'product_id' => 9,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-17 17:29:43',
                'updated_at' => '2025-12-17 17:29:43',
            ),
            278 => 
            array (
                'id' => 279,
                'order_id' => 97,
                'product_id' => 12,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-17 17:29:43',
                'updated_at' => '2025-12-17 17:29:43',
            ),
            279 => 
            array (
                'id' => 280,
                'order_id' => 98,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-09-22 03:15:43',
                'updated_at' => '2025-09-22 03:15:43',
            ),
            280 => 
            array (
                'id' => 281,
                'order_id' => 98,
                'product_id' => 11,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-09-22 03:15:43',
                'updated_at' => '2025-09-22 03:15:43',
            ),
            281 => 
            array (
                'id' => 282,
                'order_id' => 98,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-09-22 03:15:43',
                'updated_at' => '2025-09-22 03:15:43',
            ),
            282 => 
            array (
                'id' => 283,
                'order_id' => 98,
                'product_id' => 16,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-09-22 03:15:43',
                'updated_at' => '2025-09-22 03:15:43',
            ),
            283 => 
            array (
                'id' => 284,
                'order_id' => 99,
                'product_id' => 5,
                'quantity' => 5,
                'price' => '50.00',
                'created_at' => '2025-12-15 18:32:43',
                'updated_at' => '2025-12-15 18:32:43',
            ),
            284 => 
            array (
                'id' => 285,
                'order_id' => 99,
                'product_id' => 10,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-15 18:32:43',
                'updated_at' => '2025-12-15 18:32:43',
            ),
            285 => 
            array (
                'id' => 286,
                'order_id' => 99,
                'product_id' => 13,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 18:32:43',
                'updated_at' => '2025-12-15 18:32:43',
            ),
            286 => 
            array (
                'id' => 287,
                'order_id' => 99,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-15 18:32:43',
                'updated_at' => '2025-12-15 18:32:43',
            ),
            287 => 
            array (
                'id' => 288,
                'order_id' => 99,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 18:32:43',
                'updated_at' => '2025-12-15 18:32:43',
            ),
            288 => 
            array (
                'id' => 289,
                'order_id' => 100,
                'product_id' => 1,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-15 07:28:43',
                'updated_at' => '2025-12-15 07:28:43',
            ),
            289 => 
            array (
                'id' => 290,
                'order_id' => 100,
                'product_id' => 4,
                'quantity' => 5,
                'price' => '25.00',
                'created_at' => '2025-12-15 07:28:43',
                'updated_at' => '2025-12-15 07:28:43',
            ),
            290 => 
            array (
                'id' => 291,
                'order_id' => 100,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-12-15 07:28:43',
                'updated_at' => '2025-12-15 07:28:43',
            ),
            291 => 
            array (
                'id' => 292,
                'order_id' => 100,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 07:28:43',
                'updated_at' => '2025-12-15 07:28:43',
            ),
            292 => 
            array (
                'id' => 293,
                'order_id' => 101,
                'product_id' => 2,
                'quantity' => 2,
                'price' => '200.00',
                'created_at' => '2025-12-06 20:55:43',
                'updated_at' => '2025-12-06 20:55:43',
            ),
            293 => 
            array (
                'id' => 294,
                'order_id' => 101,
                'product_id' => 3,
                'quantity' => 5,
                'price' => '30.00',
                'created_at' => '2025-12-06 20:55:43',
                'updated_at' => '2025-12-06 20:55:43',
            ),
            294 => 
            array (
                'id' => 295,
                'order_id' => 101,
                'product_id' => 6,
                'quantity' => 3,
                'price' => '100.00',
                'created_at' => '2025-12-06 20:55:43',
                'updated_at' => '2025-12-06 20:55:43',
            ),
            295 => 
            array (
                'id' => 296,
                'order_id' => 101,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-06 20:55:43',
                'updated_at' => '2025-12-06 20:55:43',
            ),
            296 => 
            array (
                'id' => 297,
                'order_id' => 102,
                'product_id' => 7,
                'quantity' => 1,
                'price' => '250.00',
                'created_at' => '2025-12-19 03:00:43',
                'updated_at' => '2025-12-19 03:00:43',
            ),
            297 => 
            array (
                'id' => 298,
                'order_id' => 102,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 03:00:43',
                'updated_at' => '2025-12-19 03:00:43',
            ),
            298 => 
            array (
                'id' => 299,
                'order_id' => 103,
                'product_id' => 5,
                'quantity' => 5,
                'price' => '50.00',
                'created_at' => '2025-10-22 06:37:43',
                'updated_at' => '2025-10-22 06:37:43',
            ),
            299 => 
            array (
                'id' => 300,
                'order_id' => 103,
                'product_id' => 7,
                'quantity' => 2,
                'price' => '250.00',
                'created_at' => '2025-10-22 06:37:43',
                'updated_at' => '2025-10-22 06:37:43',
            ),
            300 => 
            array (
                'id' => 301,
                'order_id' => 103,
                'product_id' => 11,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-10-22 06:37:43',
                'updated_at' => '2025-10-22 06:37:43',
            ),
            301 => 
            array (
                'id' => 302,
                'order_id' => 103,
                'product_id' => 12,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-10-22 06:37:43',
                'updated_at' => '2025-10-22 06:37:43',
            ),
            302 => 
            array (
                'id' => 303,
                'order_id' => 104,
                'product_id' => 1,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-11-30 17:22:43',
                'updated_at' => '2025-11-30 17:22:43',
            ),
            303 => 
            array (
                'id' => 304,
                'order_id' => 104,
                'product_id' => 4,
                'quantity' => 3,
                'price' => '25.00',
                'created_at' => '2025-11-30 17:22:43',
                'updated_at' => '2025-11-30 17:22:43',
            ),
            304 => 
            array (
                'id' => 305,
                'order_id' => 104,
                'product_id' => 13,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-30 17:22:43',
                'updated_at' => '2025-11-30 17:22:43',
            ),
            305 => 
            array (
                'id' => 306,
                'order_id' => 104,
                'product_id' => 15,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-11-30 17:22:43',
                'updated_at' => '2025-11-30 17:22:43',
            ),
            306 => 
            array (
                'id' => 307,
                'order_id' => 105,
                'product_id' => 2,
                'quantity' => 3,
                'price' => '200.00',
                'created_at' => '2025-12-15 05:56:43',
                'updated_at' => '2025-12-15 05:56:43',
            ),
            307 => 
            array (
                'id' => 308,
                'order_id' => 106,
                'product_id' => 4,
                'quantity' => 1,
                'price' => '25.00',
                'created_at' => '2025-12-20 11:29:43',
                'updated_at' => '2025-12-20 11:29:43',
            ),
            308 => 
            array (
                'id' => 309,
                'order_id' => 106,
                'product_id' => 11,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-20 11:29:43',
                'updated_at' => '2025-12-20 11:29:43',
            ),
            309 => 
            array (
                'id' => 310,
                'order_id' => 106,
                'product_id' => 13,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-20 11:29:43',
                'updated_at' => '2025-12-20 11:29:43',
            ),
            310 => 
            array (
                'id' => 311,
                'order_id' => 106,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-20 11:29:43',
                'updated_at' => '2025-12-20 11:29:43',
            ),
            311 => 
            array (
                'id' => 312,
                'order_id' => 107,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-19 00:23:43',
                'updated_at' => '2025-12-19 00:23:43',
            ),
            312 => 
            array (
                'id' => 313,
                'order_id' => 107,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-19 00:23:43',
                'updated_at' => '2025-12-19 00:23:43',
            ),
            313 => 
            array (
                'id' => 314,
                'order_id' => 107,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-19 00:23:43',
                'updated_at' => '2025-12-19 00:23:43',
            ),
            314 => 
            array (
                'id' => 315,
                'order_id' => 107,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 00:23:43',
                'updated_at' => '2025-12-19 00:23:43',
            ),
            315 => 
            array (
                'id' => 316,
                'order_id' => 108,
                'product_id' => 1,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-12-18 23:03:43',
                'updated_at' => '2025-12-18 23:03:43',
            ),
            316 => 
            array (
                'id' => 317,
                'order_id' => 108,
                'product_id' => 14,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-18 23:03:43',
                'updated_at' => '2025-12-18 23:03:43',
            ),
            317 => 
            array (
                'id' => 318,
                'order_id' => 109,
                'product_id' => 1,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-11-30 17:09:43',
                'updated_at' => '2025-11-30 17:09:43',
            ),
            318 => 
            array (
                'id' => 319,
                'order_id' => 109,
                'product_id' => 3,
                'quantity' => 1,
                'price' => '30.00',
                'created_at' => '2025-11-30 17:09:43',
                'updated_at' => '2025-11-30 17:09:43',
            ),
            319 => 
            array (
                'id' => 320,
                'order_id' => 109,
                'product_id' => 5,
                'quantity' => 4,
                'price' => '50.00',
                'created_at' => '2025-11-30 17:09:43',
                'updated_at' => '2025-11-30 17:09:43',
            ),
            320 => 
            array (
                'id' => 321,
                'order_id' => 109,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-11-30 17:09:43',
                'updated_at' => '2025-11-30 17:09:43',
            ),
            321 => 
            array (
                'id' => 322,
                'order_id' => 110,
                'product_id' => 16,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-06 14:30:43',
                'updated_at' => '2025-11-06 14:30:43',
            ),
            322 => 
            array (
                'id' => 323,
                'order_id' => 111,
                'product_id' => 16,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-16 02:39:43',
                'updated_at' => '2025-12-16 02:39:43',
            ),
            323 => 
            array (
                'id' => 324,
                'order_id' => 112,
                'product_id' => 10,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 17:22:43',
                'updated_at' => '2025-12-19 17:22:43',
            ),
            324 => 
            array (
                'id' => 325,
                'order_id' => 112,
                'product_id' => 11,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 17:22:43',
                'updated_at' => '2025-12-19 17:22:43',
            ),
            325 => 
            array (
                'id' => 326,
                'order_id' => 112,
                'product_id' => 12,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 17:22:43',
                'updated_at' => '2025-12-19 17:22:43',
            ),
            326 => 
            array (
                'id' => 327,
                'order_id' => 112,
                'product_id' => 13,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 17:22:43',
                'updated_at' => '2025-12-19 17:22:43',
            ),
            327 => 
            array (
                'id' => 328,
                'order_id' => 112,
                'product_id' => 15,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 17:22:43',
                'updated_at' => '2025-12-19 17:22:43',
            ),
            328 => 
            array (
                'id' => 329,
                'order_id' => 113,
                'product_id' => 1,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-12-15 19:28:43',
                'updated_at' => '2025-12-15 19:28:43',
            ),
            329 => 
            array (
                'id' => 330,
                'order_id' => 113,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-15 19:28:43',
                'updated_at' => '2025-12-15 19:28:43',
            ),
            330 => 
            array (
                'id' => 331,
                'order_id' => 113,
                'product_id' => 3,
                'quantity' => 3,
                'price' => '30.00',
                'created_at' => '2025-12-15 19:28:43',
                'updated_at' => '2025-12-15 19:28:43',
            ),
            331 => 
            array (
                'id' => 332,
                'order_id' => 113,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-15 19:28:43',
                'updated_at' => '2025-12-15 19:28:43',
            ),
            332 => 
            array (
                'id' => 333,
                'order_id' => 113,
                'product_id' => 13,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-15 19:28:43',
                'updated_at' => '2025-12-15 19:28:43',
            ),
            333 => 
            array (
                'id' => 334,
                'order_id' => 114,
                'product_id' => 2,
                'quantity' => 3,
                'price' => '200.00',
                'created_at' => '2025-12-15 05:57:43',
                'updated_at' => '2025-12-15 05:57:43',
            ),
            334 => 
            array (
                'id' => 335,
                'order_id' => 114,
                'product_id' => 5,
                'quantity' => 5,
                'price' => '50.00',
                'created_at' => '2025-12-15 05:57:43',
                'updated_at' => '2025-12-15 05:57:43',
            ),
            335 => 
            array (
                'id' => 336,
                'order_id' => 114,
                'product_id' => 6,
                'quantity' => 4,
                'price' => '100.00',
                'created_at' => '2025-12-15 05:57:43',
                'updated_at' => '2025-12-15 05:57:43',
            ),
            336 => 
            array (
                'id' => 337,
                'order_id' => 114,
                'product_id' => 12,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-15 05:57:43',
                'updated_at' => '2025-12-15 05:57:43',
            ),
            337 => 
            array (
                'id' => 338,
                'order_id' => 115,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-12-15 07:03:43',
                'updated_at' => '2025-12-15 07:03:43',
            ),
            338 => 
            array (
                'id' => 339,
                'order_id' => 115,
                'product_id' => 8,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-12-15 07:03:43',
                'updated_at' => '2025-12-15 07:03:43',
            ),
            339 => 
            array (
                'id' => 340,
                'order_id' => 115,
                'product_id' => 13,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-15 07:03:43',
                'updated_at' => '2025-12-15 07:03:43',
            ),
            340 => 
            array (
                'id' => 341,
                'order_id' => 115,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-15 07:03:43',
                'updated_at' => '2025-12-15 07:03:43',
            ),
            341 => 
            array (
                'id' => 342,
                'order_id' => 115,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 07:03:43',
                'updated_at' => '2025-12-15 07:03:43',
            ),
            342 => 
            array (
                'id' => 343,
                'order_id' => 116,
                'product_id' => 14,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-20 22:41:43',
                'updated_at' => '2025-11-20 22:41:43',
            ),
            343 => 
            array (
                'id' => 344,
                'order_id' => 117,
                'product_id' => 8,
                'quantity' => 4,
                'price' => '150.00',
                'created_at' => '2025-12-19 13:24:43',
                'updated_at' => '2025-12-19 13:24:43',
            ),
            344 => 
            array (
                'id' => 345,
                'order_id' => 117,
                'product_id' => 13,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-19 13:24:43',
                'updated_at' => '2025-12-19 13:24:43',
            ),
            345 => 
            array (
                'id' => 346,
                'order_id' => 117,
                'product_id' => 15,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-19 13:24:43',
                'updated_at' => '2025-12-19 13:24:43',
            ),
            346 => 
            array (
                'id' => 347,
                'order_id' => 118,
                'product_id' => 6,
                'quantity' => 5,
                'price' => '100.00',
                'created_at' => '2025-11-30 02:49:43',
                'updated_at' => '2025-11-30 02:49:43',
            ),
            347 => 
            array (
                'id' => 348,
                'order_id' => 118,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-11-30 02:49:43',
                'updated_at' => '2025-11-30 02:49:43',
            ),
            348 => 
            array (
                'id' => 349,
                'order_id' => 118,
                'product_id' => 8,
                'quantity' => 3,
                'price' => '150.00',
                'created_at' => '2025-11-30 02:49:43',
                'updated_at' => '2025-11-30 02:49:43',
            ),
            349 => 
            array (
                'id' => 350,
                'order_id' => 119,
                'product_id' => 3,
                'quantity' => 2,
                'price' => '30.00',
                'created_at' => '2025-12-15 16:20:43',
                'updated_at' => '2025-12-15 16:20:43',
            ),
            350 => 
            array (
                'id' => 351,
                'order_id' => 119,
                'product_id' => 6,
                'quantity' => 1,
                'price' => '100.00',
                'created_at' => '2025-12-15 16:20:43',
                'updated_at' => '2025-12-15 16:20:43',
            ),
            351 => 
            array (
                'id' => 352,
                'order_id' => 119,
                'product_id' => 10,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-15 16:20:43',
                'updated_at' => '2025-12-15 16:20:43',
            ),
            352 => 
            array (
                'id' => 353,
                'order_id' => 119,
                'product_id' => 12,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-15 16:20:43',
                'updated_at' => '2025-12-15 16:20:43',
            ),
            353 => 
            array (
                'id' => 354,
                'order_id' => 119,
                'product_id' => 13,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-15 16:20:43',
                'updated_at' => '2025-12-15 16:20:43',
            ),
            354 => 
            array (
                'id' => 355,
                'order_id' => 120,
                'product_id' => 7,
                'quantity' => 2,
                'price' => '250.00',
                'created_at' => '2025-12-19 07:37:43',
                'updated_at' => '2025-12-19 07:37:43',
            ),
            355 => 
            array (
                'id' => 356,
                'order_id' => 120,
                'product_id' => 9,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-19 07:37:43',
                'updated_at' => '2025-12-19 07:37:43',
            ),
            356 => 
            array (
                'id' => 357,
                'order_id' => 120,
                'product_id' => 12,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-19 07:37:43',
                'updated_at' => '2025-12-19 07:37:43',
            ),
            357 => 
            array (
                'id' => 358,
                'order_id' => 120,
                'product_id' => 13,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 07:37:43',
                'updated_at' => '2025-12-19 07:37:43',
            ),
            358 => 
            array (
                'id' => 359,
                'order_id' => 120,
                'product_id' => 16,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-19 07:37:43',
                'updated_at' => '2025-12-19 07:37:43',
            ),
            359 => 
            array (
                'id' => 360,
                'order_id' => 121,
                'product_id' => 6,
                'quantity' => 2,
                'price' => '100.00',
                'created_at' => '2025-10-22 17:00:43',
                'updated_at' => '2025-10-22 17:00:43',
            ),
            360 => 
            array (
                'id' => 361,
                'order_id' => 121,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-10-22 17:00:43',
                'updated_at' => '2025-10-22 17:00:43',
            ),
            361 => 
            array (
                'id' => 362,
                'order_id' => 121,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-10-22 17:00:43',
                'updated_at' => '2025-10-22 17:00:43',
            ),
            362 => 
            array (
                'id' => 363,
                'order_id' => 121,
                'product_id' => 12,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-10-22 17:00:43',
                'updated_at' => '2025-10-22 17:00:43',
            ),
            363 => 
            array (
                'id' => 364,
                'order_id' => 122,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-12-18 12:33:43',
                'updated_at' => '2025-12-18 12:33:43',
            ),
            364 => 
            array (
                'id' => 365,
                'order_id' => 123,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-12-14 05:44:43',
                'updated_at' => '2025-12-14 05:44:43',
            ),
            365 => 
            array (
                'id' => 366,
                'order_id' => 123,
                'product_id' => 4,
                'quantity' => 4,
                'price' => '25.00',
                'created_at' => '2025-12-14 05:44:43',
                'updated_at' => '2025-12-14 05:44:43',
            ),
            366 => 
            array (
                'id' => 367,
                'order_id' => 123,
                'product_id' => 7,
                'quantity' => 3,
                'price' => '250.00',
                'created_at' => '2025-12-14 05:44:43',
                'updated_at' => '2025-12-14 05:44:43',
            ),
            367 => 
            array (
                'id' => 368,
                'order_id' => 123,
                'product_id' => 15,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-14 05:44:43',
                'updated_at' => '2025-12-14 05:44:43',
            ),
            368 => 
            array (
                'id' => 369,
                'order_id' => 123,
                'product_id' => 16,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-14 05:44:43',
                'updated_at' => '2025-12-14 05:44:43',
            ),
            369 => 
            array (
                'id' => 370,
                'order_id' => 124,
                'product_id' => 2,
                'quantity' => 4,
                'price' => '200.00',
                'created_at' => '2025-12-15 06:50:43',
                'updated_at' => '2025-12-15 06:50:43',
            ),
            370 => 
            array (
                'id' => 371,
                'order_id' => 124,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-12-15 06:50:43',
                'updated_at' => '2025-12-15 06:50:43',
            ),
            371 => 
            array (
                'id' => 372,
                'order_id' => 124,
                'product_id' => 13,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-15 06:50:43',
                'updated_at' => '2025-12-15 06:50:43',
            ),
            372 => 
            array (
                'id' => 373,
                'order_id' => 125,
                'product_id' => 11,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-29 19:36:43',
                'updated_at' => '2025-11-29 19:36:43',
            ),
            373 => 
            array (
                'id' => 374,
                'order_id' => 126,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-11-06 11:02:43',
                'updated_at' => '2025-11-06 11:02:43',
            ),
            374 => 
            array (
                'id' => 375,
                'order_id' => 126,
                'product_id' => 10,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-06 11:02:43',
                'updated_at' => '2025-11-06 11:02:43',
            ),
            375 => 
            array (
                'id' => 376,
                'order_id' => 127,
                'product_id' => 4,
                'quantity' => 2,
                'price' => '25.00',
                'created_at' => '2025-12-19 00:56:43',
                'updated_at' => '2025-12-19 00:56:43',
            ),
            376 => 
            array (
                'id' => 377,
                'order_id' => 128,
                'product_id' => 5,
                'quantity' => 5,
                'price' => '50.00',
                'created_at' => '2025-11-06 14:03:43',
                'updated_at' => '2025-11-06 14:03:43',
            ),
            377 => 
            array (
                'id' => 378,
                'order_id' => 129,
                'product_id' => 4,
                'quantity' => 2,
                'price' => '25.00',
                'created_at' => '2025-12-19 21:29:43',
                'updated_at' => '2025-12-19 21:29:43',
            ),
            378 => 
            array (
                'id' => 379,
                'order_id' => 129,
                'product_id' => 5,
                'quantity' => 5,
                'price' => '50.00',
                'created_at' => '2025-12-19 21:29:43',
                'updated_at' => '2025-12-19 21:29:43',
            ),
            379 => 
            array (
                'id' => 380,
                'order_id' => 129,
                'product_id' => 11,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 21:29:43',
                'updated_at' => '2025-12-19 21:29:43',
            ),
            380 => 
            array (
                'id' => 381,
                'order_id' => 129,
                'product_id' => 16,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-19 21:29:43',
                'updated_at' => '2025-12-19 21:29:43',
            ),
            381 => 
            array (
                'id' => 382,
                'order_id' => 130,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-11-30 17:34:43',
                'updated_at' => '2025-11-30 17:34:43',
            ),
            382 => 
            array (
                'id' => 383,
                'order_id' => 130,
                'product_id' => 9,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-30 17:34:43',
                'updated_at' => '2025-11-30 17:34:43',
            ),
            383 => 
            array (
                'id' => 384,
                'order_id' => 130,
                'product_id' => 11,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-30 17:34:43',
                'updated_at' => '2025-11-30 17:34:43',
            ),
            384 => 
            array (
                'id' => 385,
                'order_id' => 130,
                'product_id' => 12,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-30 17:34:43',
                'updated_at' => '2025-11-30 17:34:43',
            ),
            385 => 
            array (
                'id' => 386,
                'order_id' => 130,
                'product_id' => 13,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-11-30 17:34:43',
                'updated_at' => '2025-11-30 17:34:43',
            ),
            386 => 
            array (
                'id' => 387,
                'order_id' => 131,
                'product_id' => 3,
                'quantity' => 4,
                'price' => '30.00',
                'created_at' => '2025-11-06 13:09:43',
                'updated_at' => '2025-11-06 13:09:43',
            ),
            387 => 
            array (
                'id' => 388,
                'order_id' => 131,
                'product_id' => 8,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-11-06 13:09:43',
                'updated_at' => '2025-11-06 13:09:43',
            ),
            388 => 
            array (
                'id' => 389,
                'order_id' => 132,
                'product_id' => 16,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-10-22 14:12:43',
                'updated_at' => '2025-10-22 14:12:43',
            ),
            389 => 
            array (
                'id' => 390,
                'order_id' => 133,
                'product_id' => 2,
                'quantity' => 5,
                'price' => '200.00',
                'created_at' => '2025-12-13 23:05:43',
                'updated_at' => '2025-12-13 23:05:43',
            ),
            390 => 
            array (
                'id' => 391,
                'order_id' => 133,
                'product_id' => 7,
                'quantity' => 4,
                'price' => '250.00',
                'created_at' => '2025-12-13 23:05:43',
                'updated_at' => '2025-12-13 23:05:43',
            ),
            391 => 
            array (
                'id' => 392,
                'order_id' => 133,
                'product_id' => 14,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-13 23:05:43',
                'updated_at' => '2025-12-13 23:05:43',
            ),
            392 => 
            array (
                'id' => 393,
                'order_id' => 133,
                'product_id' => 16,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-13 23:05:43',
                'updated_at' => '2025-12-13 23:05:43',
            ),
            393 => 
            array (
                'id' => 394,
                'order_id' => 134,
                'product_id' => 11,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-19 10:51:43',
                'updated_at' => '2025-12-19 10:51:43',
            ),
            394 => 
            array (
                'id' => 395,
                'order_id' => 134,
                'product_id' => 16,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-19 10:51:43',
                'updated_at' => '2025-12-19 10:51:43',
            ),
            395 => 
            array (
                'id' => 396,
                'order_id' => 135,
                'product_id' => 10,
                'quantity' => 4,
                'price' => '0.00',
                'created_at' => '2025-12-21 03:34:43',
                'updated_at' => '2025-12-21 03:34:43',
            ),
            396 => 
            array (
                'id' => 397,
                'order_id' => 135,
                'product_id' => 13,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-21 03:34:43',
                'updated_at' => '2025-12-21 03:34:43',
            ),
            397 => 
            array (
                'id' => 398,
                'order_id' => 135,
                'product_id' => 16,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-12-21 03:34:43',
                'updated_at' => '2025-12-21 03:34:43',
            ),
            398 => 
            array (
                'id' => 399,
                'order_id' => 136,
                'product_id' => 5,
                'quantity' => 3,
                'price' => '50.00',
                'created_at' => '2025-12-14 22:14:43',
                'updated_at' => '2025-12-14 22:14:43',
            ),
            399 => 
            array (
                'id' => 400,
                'order_id' => 136,
                'product_id' => 8,
                'quantity' => 2,
                'price' => '150.00',
                'created_at' => '2025-12-14 22:14:43',
                'updated_at' => '2025-12-14 22:14:43',
            ),
            400 => 
            array (
                'id' => 401,
                'order_id' => 136,
                'product_id' => 9,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:14:43',
                'updated_at' => '2025-12-14 22:14:43',
            ),
            401 => 
            array (
                'id' => 402,
                'order_id' => 136,
                'product_id' => 14,
                'quantity' => 1,
                'price' => '0.00',
                'created_at' => '2025-12-14 22:14:43',
                'updated_at' => '2025-12-14 22:14:43',
            ),
            402 => 
            array (
                'id' => 403,
                'order_id' => 137,
                'product_id' => 4,
                'quantity' => 1,
                'price' => '25.00',
                'created_at' => '2025-11-06 00:52:43',
                'updated_at' => '2025-11-06 00:52:43',
            ),
            403 => 
            array (
                'id' => 404,
                'order_id' => 137,
                'product_id' => 7,
                'quantity' => 5,
                'price' => '250.00',
                'created_at' => '2025-11-06 00:52:43',
                'updated_at' => '2025-11-06 00:52:43',
            ),
            404 => 
            array (
                'id' => 405,
                'order_id' => 137,
                'product_id' => 13,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-06 00:52:43',
                'updated_at' => '2025-11-06 00:52:43',
            ),
            405 => 
            array (
                'id' => 406,
                'order_id' => 138,
                'product_id' => 1,
                'quantity' => 5,
                'price' => '150.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            406 => 
            array (
                'id' => 407,
                'order_id' => 138,
                'product_id' => 3,
                'quantity' => 2,
                'price' => '30.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            407 => 
            array (
                'id' => 408,
                'order_id' => 138,
                'product_id' => 5,
                'quantity' => 1,
                'price' => '50.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            408 => 
            array (
                'id' => 409,
                'order_id' => 138,
                'product_id' => 6,
                'quantity' => 4,
                'price' => '100.00',
                'created_at' => '2025-12-20 12:26:43',
                'updated_at' => '2025-12-20 12:26:43',
            ),
            409 => 
            array (
                'id' => 410,
                'order_id' => 139,
                'product_id' => 2,
                'quantity' => 1,
                'price' => '200.00',
                'created_at' => '2025-12-06 23:02:43',
                'updated_at' => '2025-12-06 23:02:43',
            ),
            410 => 
            array (
                'id' => 411,
                'order_id' => 140,
                'product_id' => 14,
                'quantity' => 3,
                'price' => '0.00',
                'created_at' => '2025-11-06 07:00:43',
                'updated_at' => '2025-11-06 07:00:43',
            ),
            411 => 
            array (
                'id' => 412,
                'order_id' => 140,
                'product_id' => 15,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-06 07:00:43',
                'updated_at' => '2025-11-06 07:00:43',
            ),
            412 => 
            array (
                'id' => 413,
                'order_id' => 141,
                'product_id' => 13,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-11-21 12:07:43',
                'updated_at' => '2025-11-21 12:07:43',
            ),
            413 => 
            array (
                'id' => 414,
                'order_id' => 141,
                'product_id' => 14,
                'quantity' => 5,
                'price' => '0.00',
                'created_at' => '2025-11-21 12:07:43',
                'updated_at' => '2025-11-21 12:07:43',
            ),
            414 => 
            array (
                'id' => 415,
                'order_id' => 142,
                'product_id' => 8,
                'quantity' => 1,
                'price' => '150.00',
                'created_at' => '2025-12-17 18:11:43',
                'updated_at' => '2025-12-17 18:11:43',
            ),
            415 => 
            array (
                'id' => 416,
                'order_id' => 142,
                'product_id' => 12,
                'quantity' => 2,
                'price' => '0.00',
                'created_at' => '2025-12-17 18:11:43',
                'updated_at' => '2025-12-17 18:11:43',
            ),
        ));
        
        
    }
}