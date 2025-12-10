<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Floor;
use App\Models\QrSticker;

class QrStickerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetCount = 100;
        $createdCount = 0;

        // Mevcut odalar için QR sticker oluştur
        $existingRooms = Room::where('is_active', true)->get();
        
        foreach ($existingRooms as $room) {
            // Eğer bu oda için zaten sticker yoksa oluştur
            if (!$room->qrSticker) {
                QrSticker::create([
                    'room_id' => $room->id,
                ]);
                $createdCount++;
            }
        }

        // Eğer 100'den az sticker oluşturulduysa, yeni odalar oluştur
        if ($createdCount < $targetCount) {
            $neededCount = $targetCount - $createdCount;
            
            // Mevcut katları al veya yeni katlar oluştur
            $floors = Floor::where('is_active', true)->orderBy('floor_number')->get();
            
            if ($floors->isEmpty()) {
                // Eğer kat yoksa, önce bir kat oluştur
                $floor = Floor::create([
                    'name' => '1. Kat',
                    'floor_number' => 1,
                    'description' => '1. kat',
                    'is_active' => true,
                    'sort_order' => 1,
                ]);
                $floors = collect([$floor]);
            }

            $currentFloor = $floors->last();
            $currentRoomNumber = 1;
            $currentFloorNumber = $currentFloor->floor_number;

            // Mevcut odaların en yüksek numarasını bul
            $maxRoomNumber = Room::where('floor_id', $currentFloor->id)
                ->max('room_number');
            
            if ($maxRoomNumber) {
                $currentRoomNumber = (int) $maxRoomNumber + 1;
            } else {
                $currentRoomNumber = ($currentFloorNumber * 100) + 1;
            }

            // Yeni odalar ve sticker'ları oluştur
            for ($i = 0; $i < $neededCount; $i++) {
                // Eğer bir katta 50'den fazla oda olacaksa, yeni kat oluştur
                if ($currentRoomNumber % 100 > 50) {
                    $currentFloorNumber++;
                    $currentRoomNumber = ($currentFloorNumber * 100) + 1;
                    
                    $currentFloor = Floor::firstOrCreate(
                        [
                            'floor_number' => $currentFloorNumber,
                        ],
                        [
                            'name' => $currentFloorNumber . '. Kat',
                            'description' => $currentFloorNumber . '. kat',
                            'is_active' => true,
                            'sort_order' => $currentFloorNumber,
                        ]
                    );
                }

                // Yeni oda oluştur
                $room = Room::create([
                    'floor_id' => $currentFloor->id,
                    'room_number' => (string) $currentRoomNumber,
                    'name' => 'Oda ' . $currentRoomNumber,
                    'description' => $currentFloorNumber . '. kattaki ' . $currentRoomNumber . ' numaralı oda',
                    'is_active' => true,
                    'sort_order' => $currentRoomNumber % 100,
                ]);

                // QR sticker oluştur
                QrSticker::create([
                    'room_id' => $room->id,
                ]);

                $createdCount++;
                $currentRoomNumber++;
            }
        }

        $this->command->info("Toplam {$createdCount} QR sticker oluşturuldu.");
    }
}
