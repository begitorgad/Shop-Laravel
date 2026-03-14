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
        Schema::table(table: 'products', callback: function (Blueprint $table): void {
            $table->softDeletes();
        });
        Schema::table(table: 'orders', callback: function (Blueprint $table): void {
            $table->softDeletes();
        });
        Schema::table(table: 'order_items', callback: function (Blueprint $table): void {
            $table->softDeletes();
        });
        Schema::table(table: 'categories', callback: function (Blueprint $table): void {
            $table->softDeletes();
        });
        Schema::table(table: 'users', callback: function (Blueprint $table): void {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table(table: 'orders', callback: function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });
        Schema::table(table: 'order_items', callback: function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });
        Schema::table(table: 'categories', callback: function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });
        Schema::table(table: 'users', callback: function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });
    }
};
