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
        // Update existing albums to map old categories to new ones
        DB::table('albums')->where('category', 'wedding')->update(['category' => 'prewedding']);
        DB::table('albums')->where('category', 'portrait')->update(['category' => 'personal']);
        DB::table('albums')->where('category', 'event')->update(['category' => 'ultah']);
        DB::table('albums')->where('category', 'family')->update(['category' => 'keluarga']);
        DB::table('albums')->where('category', 'graduation')->update(['category' => 'dokumentasi']);
        DB::table('albums')->where('category', 'other')->update(['category' => 'corporate']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the category changes
        DB::table('albums')->where('category', 'prewedding')->update(['category' => 'wedding']);
        DB::table('albums')->where('category', 'personal')->update(['category' => 'portrait']);
        DB::table('albums')->where('category', 'ultah')->update(['category' => 'event']);
        DB::table('albums')->where('category', 'keluarga')->update(['category' => 'family']);
        DB::table('albums')->where('category', 'dokumentasi')->update(['category' => 'graduation']);
        DB::table('albums')->where('category', 'corporate')->update(['category' => 'other']);
    }
};