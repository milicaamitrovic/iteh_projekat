<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('grupa_za_nastavu_id')->after('administrator');
            $table->foreign('grupa_za_nastavu_id')->references('id')->on('grupa_za_nastavus');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('grupa_za_nastavu_id');
        });
    }
};
