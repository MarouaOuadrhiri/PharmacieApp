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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string('Inbe')->unique();
            $table->string('NomPhar');
            $table->string('Adresse');
            $table->string('VillePh');
            $table->string('email')->unique();
            $table->string("NumTele",13)->unique();
            $table->string("NumFx",13)->unique();
            $table->boolean('confirmer')->default(false);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
