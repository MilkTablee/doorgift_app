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
        Schema::table('order_product', function (Blueprint $table) {
            $table->foreignId('packaging_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropForeign(['packaging_id']);
            $table->dropColumn('packaging_id');
        });
    }
};