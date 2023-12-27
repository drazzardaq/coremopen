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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id')->default(4);
            $table->foreignId('priority_id')->default(1);
            $table->foreignId('status_id')->default(1);
            $table->string('title', 89);
            $table->text('description')->nullable();
            $table->text('closure')->nullable();
            $table->boolean('recurring')->default(false);
            $table->date('date')->nullable();
            $table->string('tag', 55)->nullable();
            // $table->json('related_ids')->nullable();
            $table->boolean('archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
