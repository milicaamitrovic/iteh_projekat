<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stavka_rasporedas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raspored_id');
            $table->foreign('raspored_id')->references('id')->on('raspored_nastaves')->onDelete('cascade');
            $table->unsignedBigInteger('dan_id');
            $table->foreign('dan_id')->references('id')->on('dans')->onDelete('cascade');
            $table->unsignedBigInteger('vremenski_interval_id');
            $table->foreign('vremenski_interval_id')->references('id')->on('vremenski_intervals')->onDelete('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('predmet_id');
            $table->foreign('predmet_id')->references('id')->on('predmets');
            $table->timestamps();

           // $table->primary(['id', 'raspored_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stavka_rasporedas');
    }
};
