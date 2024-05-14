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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category'); // delete current 'category' column
            $table->unsignedBigInteger('category_id')->after('title'); // add new 'category_id' column as foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Define foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category')->after('title');
        });
    }
};
