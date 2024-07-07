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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->unsignedBigInteger('consumer_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('name');
            $table->string('category');
            $table->integer('harga_unit');
            $table->integer('konsumsi_harian')->nullable();
            $table->integer('lead_time');
            $table->integer('safety_stock');
            $table->integer('rop')->nullable();
            $table->integer('total_persediaan');
            $table->timestamps();

            $table->foreign('consumer_id')
                ->references('id')
                ->on('consumers')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
