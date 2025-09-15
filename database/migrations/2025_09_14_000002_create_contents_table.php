<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_source_id')->constrained()->onDelete('cascade');
            $table->string('external_id')->index();
            $table->string('title');
            $table->enum('type', ['video', 'article', 'text'])->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('duration_seconds')->default(0);
            $table->integer('reading_time')->default(0);
            $table->integer('reactions')->default(0);
            $table->integer('comments')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->float('score')->default(0);
            $table->json('raw')->nullable();
            $table->timestamps();

            $table->unique(['data_source_id', 'external_id']);
            $table->index(['score', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
