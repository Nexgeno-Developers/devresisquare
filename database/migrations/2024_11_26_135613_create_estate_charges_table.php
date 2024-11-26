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
        Schema::create('estate_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_no');
            $table->unsignedBigInteger('property_id');
            $table->integer('ownergroup_id')->nullable();
            $table->string('description', 550);
            $table->tinyInteger('paid_by_landlord')->default(0);
            $table->tinyInteger('managed_by_property')->default(0);
            $table->integer('charge_landlord')->nullable();
            $table->integer('tax')->default(0);
            $table->decimal('schedule_charge', 10, 0)->nullable();
            $table->longText('attachment');
            $table->string('type');
            $table->date('due_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount', 10, 0);
            $table->string('frequency');
            $table->string('status');
            $table->integer('added_by');
            $table->timestamps();

            // Foreign key reference to properties table
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');  // Optional: set to cascade or restrict as needed
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('estate_charges', function (Blueprint $table) {
            // Drop foreign key constraint before dropping the column
            $table->dropForeign(['property_id']);
        });

        Schema::dropIfExists('estate_charges');
    }
};
