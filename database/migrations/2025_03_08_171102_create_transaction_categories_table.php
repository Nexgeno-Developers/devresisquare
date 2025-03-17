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
        Schema::create('transaction_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Optionally, insert default categories
        DB::table('transaction_categories')->insert([
            ['name' => 'Salary'],
            ['name' => 'Advance Payment'],
            ['name' => 'Utility'],
            ['name' => 'Electricity Bill'],
            ['name' => 'Travel'],
            ['name' => 'Other'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_categories');
    }
};
