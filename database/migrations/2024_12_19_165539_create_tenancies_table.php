<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

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
            $table->unsignedBigInteger('tenancy_sub_status_id')->nullable();
            $table->unsignedBigInteger('tenancy_type_id')->nullable();
            $table->date('move_in')->nullable();
            $table->date('move_out')->nullable();
            $table->date('tenancy_renewal_confirm_date')->nullable();  // in months
            $table->date('extension_date')->nullable();
            $table->decimal('rent', 10, 2)->nullable();  // Rent price
            $table->decimal('deposit', 10, 2)->nullable();  // Rent deposit
            $table->string('deposit_type')->nullable();  // Deposit type
            $table->integer('deposit_number')->nullable();
            $table->string('deposit_held_by')->nullable();
            $table->string('deposit_service')->nullable();  // For TDS/DPS number or scheme name
            $table->boolean('periodic')->default(false);
            $table->boolean('rolling_contract')->default(false);
            $table->boolean('renewal_exempt')->default(false);
            $table->integer('term_months')->nullable();
            $table->integer('term_days')->nullable();
            $table->enum('frequency', ['Monthly', 'Weekly'])->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Terminated', 'Archived'])->default('Active');
            $table->timestamps();

            // Add foreign key constraints manually
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('set null');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
            $table->foreign('tenancy_sub_status_id')->references('id')->on('tenancy_sub_statuses')->onDelete('set null');
            $table->foreign('tenancy_type_id')->references('id')->on('tenancy_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenancies', function (Blueprint $table) {
            // Drop foreign keys with the correct names
            try {
                $table->dropForeign('tenancies_property_id_foreign');
                $table->dropColumn('property_id');
            } catch (\Exception $e) {
                // Log the exception or silently ignore
                Log::info('Foreign key tenancies_property_id_foreign does not exist.');
            }

            try {
                $table->dropForeign('tenancies_offer_id_foreign');
                $table->dropColumn('offer_id');
            } catch (\Exception $e) {
                // Log the exception or silently ignore
                Log::info('Foreign key tenancies_offer_id_foreign does not exist.');
            }

            try {
                $table->dropForeign('tenancies_tenancy_sub_status_id_foreign');
                $table->dropColumn('tenancy_sub_status_id');
            } catch (\Exception $e) {
                // Log the exception or silently ignore
                Log::info('Foreign key tenancies_tenancy_sub_status_id_foreign does not exist.');
            }

            try {
                $table->dropForeign('tenancies_tenancy_type_id_foreign');
                $table->dropColumn('tenancy_type_id');
            } catch (\Exception $e) {
                // Log the exception or silently ignore
                Log::info('Foreign key tenancies_tenancy_type_id_foreign does not exist.');
            }
        });

        Schema::dropIfExists('tenancies');
    }
};
