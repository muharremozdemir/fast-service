<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Floor;
use App\Models\Room;

class FloorRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 5 kat oluştur
        for ($floorNumber = 1; $floorNumber <= 5; $floorNumber++) {
            $floor = Floor::create([
                'name' => $floorNumber . '. Kat',
                'floor_number' => $floorNumber,
                'description' => $floorNumber . '. kat açıklaması',
                'is_active' => true,
                'sort_order' => $floorNumber,
            ]);

            // Her kat için 5 oda oluştur
            for ($roomNum = 1; $roomNum <= 5; $roomNum++) {
                $roomNumber = ($floorNumber * 100) + $roomNum; // 101, 102, 103, 201, 202, vb.
                Room::create([
                    'floor_id' => $floor->id,
                    'room_number' => (string)$roomNumber,
                    'name' => 'Oda ' . $roomNumber,
                    'description' => $floorNumber . '. kattaki ' . $roomNumber . ' numaralı oda',
                    'is_active' => true,
                    'sort_order' => $roomNum,
                ]);
            }
        }
    }
}
