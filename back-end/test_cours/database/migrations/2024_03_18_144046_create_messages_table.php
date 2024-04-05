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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->boolean('read');
            $table->integer('conversation_id');
            $table->string('type');
            $table->integer('sender_id');
            
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
