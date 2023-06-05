<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($counter = 1; $counter <= 5; $counter++) {
            $roomName = 'Room Name ' . $counter;
            $roomHash = hash('sha256', Str::random(40));
            

            DB::table('rooms')->insert([
                'room_name' => $roomName,
                'room_desc' => 'Description ' . $counter,
                'created_at' => now(),
                'updated_at' => now(),
                'room_hash' => $roomHash,
            ]);
        }
    }
}
