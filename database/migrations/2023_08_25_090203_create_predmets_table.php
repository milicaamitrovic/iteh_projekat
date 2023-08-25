<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('predmets', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_predmeta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('predmets');
    }
};
