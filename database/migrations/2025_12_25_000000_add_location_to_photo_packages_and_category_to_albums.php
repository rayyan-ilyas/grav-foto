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
        Schema::table('photo_packages', function (Blueprint $table) {
            $table->string('location')->default('indoor')->after('is_active')->comment('indoor|outdoor');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_packages', function (Blueprint $table) {
            $table->dropColumn('location');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
