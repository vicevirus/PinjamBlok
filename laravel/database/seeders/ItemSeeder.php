<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($counter = 1; $counter <= 5; $counter++) {
            $itemName = 'Item ' . $counter;
            $itemHash = hash('sha256', Str::random(40));
            $item_type = 'Item Type' . $counter;

            DB::table('items')->insert([
                'item_name' => $itemName,
                'item_desc' => 'Description ' . $counter,
                'item_type' => $item_type,
                'created_at' => now(),
                'updated_at' => now(),
                'item_hash' => $itemHash,
            ]);
        }
    }
}
