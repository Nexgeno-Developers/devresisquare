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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('works_order_no')->unique();
            $table->foreignId('repair_issue_id')->constrained()->onDelete('cascade');
            // $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');

            // Job Type & Job Sub Type (Foreign Keys)
            $table->foreignId('job_type_id')->nullable()->constrained('job_types')->onDelete('set null');
            $table->foreignId('job_sub_type_id')->nullable()->constrained('job_types')->onDelete('set null');

            $table->string('job_reference_no')->nullable();
            $table->text('job_description')->nullable();
            $table->date('date');
            $table->time('time')->nullable();
            $table->text('extra_notes')->nullable();

            // Contact & Invoice Details
            $table->string('invoice_to_name')->nullable();
            $table->string('invoice_to_address')->nullable();
            $table->string('invoice_to_email')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();

            // Full Access Details
            $table->text('full_access_details')->nullable();

            // Problem Description
            $table->text('problem_issue')->nullable();
            $table->boolean('photos_videos_attached')->default(false);
            $table->boolean('floor_plan_attached')->default(false);

            // Status & Timestamps
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
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
