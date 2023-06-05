<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->time('duration');
            $table->bigInteger('borrower_id');
            $table->bigInteger('item_id');
            $table->bigInteger('room_id');
            $table->timestamps();
            $table->string('transact_hash')->unique()->default(hash('sha256', Str::random(40)));
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
