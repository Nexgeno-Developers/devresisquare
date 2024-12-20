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
        Schema::create('tenancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->nullable(); // Explicitly defining the type
            $table->unsignedBigInteger('offer_id')->nullable();   // Explicitly defining the type
            $table->string('sub_status')->nullable();
            $table->date('move_in')->nullable();
            $table->date('move_out')->nullable();
            $table->integer('tenancy_length')->nullable();  // in months
            $table->date('extension_date')->nullable();
            $table->decimal('price', 10, 2)->nullable();  // Rent price
            $table->decimal('deposit', 10, 2)->nullable();  // Rent deposit
            $table->enum('frequency', ['Monthly', 'Weekly'])->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Terminated', 'Archived'])->default('Active');
            $table->timestamps();

            // Add foreign key constraints manually
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('set null');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenancies');
    }
};
