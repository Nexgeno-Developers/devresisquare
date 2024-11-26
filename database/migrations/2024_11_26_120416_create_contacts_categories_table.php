<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('contacts_categories', function (Blueprint $table) {
            $table->id(); // automatically unsigned big integer and primary key
            $table->string('name', 155);
            $table->boolean('status')->default(1)->comment('1 for active, 0 for inactive');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts_categories');
    }
}
