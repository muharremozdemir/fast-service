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
                'company_id' => NULL,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:50',
                'password' => '$2y$12$1yThKHu7uEffz1PsLzIOEuEp20aOFjNrAdylASj498glB7o6fsG0K',
                'remember_token' => '0l7eQbrlLn',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => NULL,
                'name' => 'Admin',
                'email' => 'iletisim@hotelfastservice.com',
                'phone' => NULL,
                'email_verified_at' => NULL,
                'password' => '$2y$12$2q9ai8i50pJxdAxZNgkMOu3p.LRX04rA.dCDEoJazyhg1k5SRp8M.',
                'remember_token' => 'rmi1fmxFgZxrPoZTurfb05dL4h9yHiLU9QNHvQqejPjFCec3Y04Zy5MjjwLG',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 1,
                'name' => 'Yönetici',
                'email' => 'iletisim@muharremozdemir.com',
                'phone' => NULL,
                'email_verified_at' => NULL,
                'password' => '$2y$12$eY0uGIcoBNIaa5bDyz3srOnkYTteTQpEwD36BmoYna0SRExYmV78C',
                'remember_token' => 'Qv36E2xEcf98gk9aTW1Mtfi9m4GwIKWjXx4BLyf5xJ0mgVb8tl1oMonlcIk9',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => NULL,
                'name' => 'Ahmet Yılmaz',
                'email' => 'gorevli1@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:51',
                'password' => '$2y$12$E3BJgX8QIHhMUbpM.kq7UeNzvKFuIDze1yOd6lhnhys/TrrgGnW4S',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => NULL,
                'name' => 'Mehmet Demir',
                'email' => 'gorevli2@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:52',
                'password' => '$2y$12$YnLGZ0Uet2mkWRO7XD94JOHU1QP35BTuDX0Z1rVzoQ41kxO3qyBiu',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:52',
                'updated_at' => '2025-12-21 15:52:52',
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => NULL,
                'name' => 'Ayşe Kaya',
                'email' => 'gorevli3@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:52',
                'password' => '$2y$12$eKlEh8P4ZYJ.SP7uhtGsZuycVFf2lQ00yMAx1L9cI7sV6XQbwFV6W',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:52',
                'updated_at' => '2025-12-21 15:52:52',
            ),
            6 => 
            array (
                'id' => 7,
                'company_id' => NULL,
                'name' => 'Fatma Şahin',
                'email' => 'gorevli4@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:52',
                'password' => '$2y$12$hlJjlJLX7WtSWgyXbBmK7OqJfrBep1bS/ym5WxfGhWQIW6atHuuzu',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:52',
                'updated_at' => '2025-12-21 15:52:52',
            ),
            7 => 
            array (
                'id' => 8,
                'company_id' => NULL,
                'name' => 'Ali Öztürk',
                'email' => 'gorevli5@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:52',
                'password' => '$2y$12$F9fCDvjpKIWnn6QAl87A1OdIb/5dVz4pYUlcoI32u9RHqa0LQdnOS',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:52',
                'updated_at' => '2025-12-21 15:52:52',
            ),
            8 => 
            array (
                'id' => 9,
                'company_id' => NULL,
                'name' => 'Zeynep Arslan',
                'email' => 'gorevli6@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:53',
                'password' => '$2y$12$4HAIwQVqPxh2V0w2CnF00.8DejLoGA9SeNtLqrdXWLhx41bU/yIWW',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:53',
                'updated_at' => '2025-12-21 15:52:53',
            ),
            9 => 
            array (
                'id' => 10,
                'company_id' => NULL,
                'name' => 'Mustafa Çelik',
                'email' => 'gorevli7@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:53',
                'password' => '$2y$12$lccCglfkETb4udHGY1nke.pndBK7b0ujX9goNOZx.PassDK2cTxRe',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:53',
                'updated_at' => '2025-12-21 15:52:53',
            ),
            10 => 
            array (
                'id' => 11,
                'company_id' => NULL,
                'name' => 'Elif Yıldız',
                'email' => 'gorevli8@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:53',
                'password' => '$2y$12$ncGdw6DfsQZg2yf8GJ1OcuxQ6lgY542Mdq3MYyHM1zqk1x2JuXzxy',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:53',
                'updated_at' => '2025-12-21 15:52:53',
            ),
            11 => 
            array (
                'id' => 12,
                'company_id' => NULL,
                'name' => 'Hasan Aydın',
                'email' => 'gorevli9@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:53',
                'password' => '$2y$12$G5fIuG9D2.MoK//U0BQDheGdreVJN/Y4OJNrV54qybuAenpzGaEmy',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:53',
                'updated_at' => '2025-12-21 15:52:53',
            ),
            12 => 
            array (
                'id' => 13,
                'company_id' => NULL,
                'name' => 'Selin Doğan',
                'email' => 'gorevli10@example.com',
                'phone' => NULL,
                'email_verified_at' => '2025-12-21 15:52:54',
                'password' => '$2y$12$2Hy1UKupN3EsdbxvzQrwyOUjBkUBePBG1HZ85hl6tA1q7fcpgU7X6',
                'remember_token' => NULL,
                'created_at' => '2025-12-21 15:52:54',
                'updated_at' => '2025-12-21 15:52:54',
            ),
            13 => 
            array (
                'id' => 14,
                'company_id' => 3,
                'name' => 'Ali Osman Özdemir',
                'email' => 'aliosman@ozdemirhotel.com',
                'phone' => '5423024234',
                'email_verified_at' => NULL,
                'password' => '$2y$12$ABvcZSMYAaojEsVLDT2c8u61Lua29Qw02fE4IGBFAVkk3lFgOIv8i',
                'remember_token' => 'oCeUL46oplUa3DDfAiRRECKXkjyUm7TOlhJmmNV9f6iroTAkjOqoDtWgDMpV',
                'created_at' => '2025-12-24 19:18:40',
                'updated_at' => '2025-12-24 19:18:40',
            ),
        ));
        
        
    }
}