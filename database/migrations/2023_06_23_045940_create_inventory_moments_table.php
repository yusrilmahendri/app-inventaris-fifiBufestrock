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
        Schema::create('inventory_moments', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->integer('quantity');
            $table->enum('type', ['masuk', 'keluar']);
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_moments');
    }
};
