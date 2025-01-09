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
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('contact_id'); // Foreign key to contacts table
            $table->string('employment_status')->nullable(); // Employment Status
            $table->string('business_name')->nullable(); // Business Name (if applicable)
            $table->boolean('guarantee')->nullable();
            $table->boolean('previously_rented')->nullable(); // Has previously rented?
            $table->boolean('poor_credit')->nullable(); // Poor credit history?
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_details');
    }
};
