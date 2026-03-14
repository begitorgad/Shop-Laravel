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
        Schema::create(table: 'order_items', callback: function (Blueprint $table): void {
            $table->id();
            $table->integer(column: 'quantity');
            $table->decimal(column: 'unit_price',total: 8,places: 2);

            $table->foreignId(column: 'order_id')->constrained()->onDelete(action: 'cascade');
            $table->foreignId(column:'product_id')->constrained()->onDelete(action: 'cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
