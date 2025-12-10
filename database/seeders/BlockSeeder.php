<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Block;
use App\Models\Floor;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3 blok oluştur
        $blocks = [
            [
                'name' => 'A Blok',
                'block_code' => 'A',
                'description' => 'Ana blok',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'B Blok',
                'block_code' => 'B',
                'description' => 'İkinci blok',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'C Blok',
                'block_code' => 'C',
                'description' => 'Üçüncü blok',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        $createdBlocks = [];
        foreach ($blocks as $blockData) {
            $block = Block::create($blockData);
            $createdBlocks[] = $block;
        }

        // Mevcut katları al ve bloklar arasında bölüştür
        $floors = Floor::orderBy('floor_number')->get();
        
        if ($floors->count() > 0 && count($createdBlocks) > 0) {
            $floorsPerBlock = ceil($floors->count() / count($createdBlocks));
            $blockIndex = 0;
            
            foreach ($floors as $index => $floor) {
                // Her bloka eşit sayıda kat dağıt
                if ($index > 0 && $index % $floorsPerBlock == 0 && $blockIndex < count($createdBlocks) - 1) {
                    $blockIndex++;
                }
                
                $floor->block_id = $createdBlocks[$blockIndex]->id;
                $floor->save();
            }
        }

        $this->command->info('3 blok oluşturuldu ve katlar aralarında bölüştürüldü.');
    }
}
