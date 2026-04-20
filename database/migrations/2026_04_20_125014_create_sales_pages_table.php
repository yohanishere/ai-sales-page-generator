<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales_pages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title')->nullable();

            // OUTPUT AI
            $table->string('headline')->nullable();
            $table->string('subheadline')->nullable();
            $table->text('description')->nullable();

            $table->json('benefits')->nullable();
            $table->json('features')->nullable();

            $table->text('social_proof')->nullable();
            $table->string('price_display')->nullable();
            $table->string('cta')->nullable();

            // STYLE
            $table->string('style')->default('default');

            // INPUT USER
            $table->json('input_data')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_pages');
    }
};