<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('prezime')->after('ime');
            $table->string('broj_indeksa')->unique()->after('prezime');
            $table->boolean('administrator')->default(false)->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('prezime');
            $table->removeColumn('broj_indeksa');
            $table->removeColumn('administrator');
        });
    }
};
