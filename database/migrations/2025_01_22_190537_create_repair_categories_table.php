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
        Schema::create('repair_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('repair_categories')->onDelete('set null');
            $table->integer('level');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            // Add unique constraint on name, parent_id, and level
            $table->unique(['name', 'parent_id', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_categories');
    }
};
