<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raspored_nastaves', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_rasporeda');
            $table->date('datum_od');
            $table->date('datum_do');
            $table->unsignedBigInteger('grupa_za_nastavu_id');
            $table->foreign('grupa_za_nastavu_id')->references('id')->on('grupa_za_nastavus')->onDelete('cascade');
            $table->unsignedBigInteger('korisnik_id');
            $table->foreign('korisnik_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raspored_nastaves');
    }
};
