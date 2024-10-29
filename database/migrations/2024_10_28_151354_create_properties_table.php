<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('prop_name');
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('postcode');
            $table->string('property_type');
            $table->string('transaction_type');
            $table->string('specific_property_type');
            $table->string('bedroom');
            $table->string('bathroom');
            $table->string('reception');
            $table->string('service')->nullable(); // Assuming service can be nullable
            $table->decimal('price', 10, 2);
            $table->date('available_from');
            $table->date('start_date')->nullable(); // Assuming start_date can be nullable
            $table->date('end_date')->nullable(); // Assuming end_date can be nullable
            $table->string('status')->nullable(); // Assuming status can be nullable
            $table->foreignId('added_by')->constrained('users')->onDelete('cascade'); // Assuming added_by references users table
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null'); // Assuming deleted_by references users table
            $table->softDeletes(); // For soft deletes, which will handle deleted_at

            $table->timestamps(); // Automatically creates created_at and updated_at columns
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
