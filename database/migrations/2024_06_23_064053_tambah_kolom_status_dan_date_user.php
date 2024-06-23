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
        Schema::table('magang', function (Blueprint $table){
            $table->string('status')->nullable()->after('remember_token');
            $table->date('mulai_magang')->nullable()->after('remember_token');
            $table->date('selesai_magang')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
