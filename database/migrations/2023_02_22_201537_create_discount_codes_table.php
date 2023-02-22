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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id');
            $table->string('code')->unique();
            $table->string('discount_rate')->nullable(); // nullable; because there is information about it in the document
            $table->date('expire_date')->nullable(); // nullable; because there is information about it in the document
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
