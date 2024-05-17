<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('discount_temp');
        });

        DB::table('products')->update([
            'discount_temp' => DB::raw('CAST(discount AS UNSIGNED)')
        ]);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->renameColumn('discount_temp', 'discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount', 5, 2);
        });

        DB::table('products')->update([
            'discount' => DB::raw('CAST(discount AS DECIMAL(5, 2))')
        ]);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
};
