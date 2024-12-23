<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('owner_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id'); // Foreign key referencing properties table (unsignedBigInteger)
            $table->unsignedBigInteger('contact_id')->nullable(); // Foreign key referencing contacts table (unsignedBigInteger)
            $table->string('contact_ids', 155)->nullable(); // Foreign key referencing contacts table (unsignedBigInteger)
            $table->date('purchased_date');
            $table->date('sold_date')->nullable();
            $table->date('archived_date')->nullable();
            $table->string('status', 10)->default('active');
            $table->timestamps();

            // Add the foreign key constraint for property_id
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

            // Add the foreign key constraint for contact_id
            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('owner_group', function (Blueprint $table) {
            // Drop foreign key constraints before dropping the table
            $table->dropForeign(['property_id']);
            $table->dropForeign(['contact_id']);
        });

        Schema::dropIfExists('owner_group');
    }
};
