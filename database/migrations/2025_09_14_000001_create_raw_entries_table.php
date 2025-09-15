<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('raw_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_source_id')->constrained()->onDelete('cascade');
            $table->longText('payload')->nullable();
            $table->string('format')->nullable();
            $table->integer('http_status')->nullable();
            $table->timestamp('fetched_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raw_entries');
    }
};
