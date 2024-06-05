<?php

declare(strict_types=1);

use App\Models\Author;
use App\Models\ElectionDay;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();

            $table->foreignIdFor(Author::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(ElectionDay::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('country');

            $table->string('title');
            $table->text('content');
            $table->json('embeds')->nullable();
        });
    }
};
