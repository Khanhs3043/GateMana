<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unknown_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_id'); // Lưu ID của thẻ lạ
            $table->timestamp('detected_at')->nullable(); // Thời gian thẻ được phát hiện
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unknown_cards');
    }
};
