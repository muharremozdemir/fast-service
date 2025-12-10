<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffNames = [
            'Ahmet Yılmaz',
            'Mehmet Demir',
            'Ayşe Kaya',
            'Fatma Şahin',
            'Ali Öztürk',
            'Zeynep Arslan',
            'Mustafa Çelik',
            'Elif Yıldız',
            'Hasan Aydın',
            'Selin Doğan',
        ];

        foreach ($staffNames as $index => $name) {
            User::create([
                'name' => $name,
                'email' => 'gorevli' . ($index + 1) . '@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
