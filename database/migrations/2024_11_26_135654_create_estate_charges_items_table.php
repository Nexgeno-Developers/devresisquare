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
        Schema::create('estate_charges_items', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('estate_charge_id')->unsigned();   // Use unsigned bigInteger to match the id of estate_charges
            $table->decimal('amount', 65, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('tax_amount', 65, 2);
            $table->longText('charge_attachment')->nullable();
            $table->string('status', 155);
            $table->timestamps();

            // Foreign key reference to estate_charges
            $table->foreign('estate_charge_id')
                ->references('id')
                ->on('estate_charges')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('estate_charges_items', function (Blueprint $table) {
            // Drop foreign key constraint before dropping the column
            $table->dropForeign(['estate_charge_id']);
        });

        Schema::dropIfExists('estate_charges_items');
    }
};
