<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($counter = 1; $counter <= 5; $counter++) {

            $transactHash = hash('sha256', Str::random(40));

            $action = $counter % 2 === 0 ? 'return' : 'borrow';

            $duration = $this->generateRandomDuration();

            DB::table('transactions')->insert([
                'action' => $action,
                'duration' => $duration,
                'borrower_id' => $counter,
                'item_id' => $counter,
                'room_id' => $counter,
                'created_at' => now(),
                'updated_at' => now(),
                'transact_hash' => $transactHash


                // Other column values
            ]);
        }
    }

    private function generateRandomDuration()
    {
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
}
