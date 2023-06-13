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
        Schema::create('travel', function (Blueprint $table) {
            $table->uuid();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->tinyInteger('numberOfDays');
            $table->tinyInteger('numberOfNights');
            $table->boolean('isPublic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};
