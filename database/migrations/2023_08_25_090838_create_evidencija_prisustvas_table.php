<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evidencija_prisustvas', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('korisnik_id');
            $table->foreign('korisnik_id')->references('id')->on('users');
            $table->boolean('prisustvo');
            $table->timestamps();

            $table->primary(['id', 'korisnik_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidencija_prisustvas');
    }
};
