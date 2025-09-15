<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['view', 'like', 'reaction']);
            $table->integer('count')->default(0);
            $table->timestamps();

            $table->unique(['content_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
