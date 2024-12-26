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
        Schema::create('owner_group_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_group_id')->constrained('owner_group')->onDelete('cascade');
            $table->unsignedBigInteger('contact_id')->nullable(); // Ensure it is nullable
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null'); // Manual foreign key definition
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner_group', function (Blueprint $table) {
            // Drop foreign key constraints before dropping the table
            $table->dropForeign(['owner_group_id']);
            $table->dropForeign(['contact_id']);
        });

        Schema::dropIfExists('owner_group_contacts');
    }
};
