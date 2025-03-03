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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('works_order_no')->unique();
            $table->foreignId('repair_issue_id')->constrained()->onDelete('cascade');
            // $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('job_type_id')->nullable()->constrained('job_types')->onDelete('set null');
            $table->foreignId('job_sub_type_id')->nullable()->constrained('job_types')->onDelete('set null');
            $table->string('job_status')->nullable();
            $table->text('job_scope')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->string('invoice_to')->nullable();
            $table->date('tentative_start_date')->nullable();
            $table->date('tentative_end_date')->nullable();
            $table->date('booked_date')->nullable();
            $table->string('quote_attachment')->nullable(); // Quote Attachment (File Path)
            $table->decimal('actual_cost', 10, 2)->nullable(); // Actual Cost
            $table->decimal('charge_to_landlord', 10, 2)->nullable(); // Landlord Charge
            $table->string('payment_by')->nullable(); // Payment Terms
            $table->decimal('estimated_cost', 10, 2)->nullable(); // Estimated Cost
            $table->text('extra_notes')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
