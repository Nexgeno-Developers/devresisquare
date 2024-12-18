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
            $table->string('prop_ref_no')->nullable();
            $table->string('prop_name')->nullable();
            $table->string('line_1')->nullable();
            $table->string('line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->string('property_type')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('specific_property_type')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('reception')->nullable();
            $table->string('parking')->nullable();
            $table->string('parking_location',50)->nullable();
            $table->string('balcony')->nullable();
            $table->string('garden')->nullable();
            $table->string('service')->nullable();
            $table->string('management')->nullable();
            $table->string('collecting_rent')->nullable();
            $table->string('floor')->nullable();
            $table->decimal('square_feet', 10, 4)->nullable();
            $table->decimal('square_meter', 10, 4)->nullable();
            $table->string('aspects')->nullable();
            $table->string('sales_current_status',155)->nullable();
            $table->string('letting_current_status',155)->nullable();
            $table->string('status_description')->nullable();
            $table->date('available_from')->nullable();
            $table->boolean('pets_allow')->default(0)->comment('1 for yes, 0 for no');
            $table->json('market_on')->nullable();
            $table->json('features')->nullable(); // Stores as JSON array
            $table->string('furniture',555)->nullable();
            $table->string('kitchen',555)->nullable();
            $table->string('heating_cooling',555)->nullable();
            $table->string('safety',555)->nullable();
            $table->string('other',555)->nullable();
            $table->string('access_arrangement',255)->nullable();
            $table->string('key_highlights',255)->nullable();
            $table->string('nearest_station')->nullable();
            $table->string('nearest_school')->nullable();
            $table->json('nearest_religious_places')->nullable();
            $table->string('useful_information',255)->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('ground_rent', 12, 2)->nullable();
            $table->decimal('service_charge', 12, 2)->nullable();
            $table->decimal('estate_charge', 12, 2)->nullable();
            $table->decimal('miscellaneous_charge', 12, 2)->nullable();
            $table->unsignedBigInteger('estate_charges_id')->nullable(); // Create the column

            // // Define the foreign key constraint
            // $table->foreign('estate_charges_id')
            //       ->references('id')
            //       ->on('estate_charges')
            //       ->onDelete('cascade'); // Automatically delete related records when estate_charges is deleted

            $table->decimal('annual_council_tax', 10, 2)->nullable();
            $table->string('council_tax_band')->nullable();
            $table->string('local_authority',255)->nullable();
            $table->decimal('letting_price', 10, 2)->nullable();
            $table->string('tenure')->nullable();
            $table->integer('length_of_lease')->nullable();
            $table->string('epc_rating')->nullable();
            $table->boolean('is_gas')->nullable();
            $table->boolean('gas_safe_acknowledged')->nullable();
            $table->string('photos', 2000)->nullable();
            $table->string('floor_plan', 2000)->nullable();
            $table->string('view_360', 2000)->nullable();
            // $table->json('photos')->nullable(); // Stores multiple photo URLs as JSON array
            // $table->json('floor_plan')->nullable(); // Stores multiple floor plan URLs as JSON array
            // $table->json('view_360')->nullable(); // Stores multiple 360-view URLs if needed
            $table->string('video_url', 255)->nullable(); // Stores multiple video URLs if needed
            $table->string('designation')->nullable();
            $table->string('branch')->nullable();
            $table->decimal('commission_percentage', 5, 2)->nullable();
            $table->decimal('commission_amount', 10, 2)->nullable();
            $table->integer('step')->nullable();
            $table->integer('quick_step')->nullable();
            $table->foreignId('added_by')->nullable()->constrained('users')->onDelete('set null');
            // $table->foreignId('added_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();

        });

        // Schema::create('properties', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('prop_name');
        //     $table->string('line_1');
        //     $table->string('line_2')->nullable();
        //     $table->string('city');
        //     $table->string('country');
        //     $table->string('postcode');
        //     $table->string('property_type');
        //     $table->string('transaction_type');
        //     $table->string('specific_property_type');
        //     $table->string('bedroom');
        //     $table->string('bathroom');
        //     $table->string('reception');
        //     $table->string('service')->nullable(); // Assuming service can be nullable
        //     $table->decimal('price', 10, 2);
        //     $table->date('available_from');
        //     $table->date('start_date')->nullable(); // Assuming start_date can be nullable
        //     $table->date('end_date')->nullable(); // Assuming end_date can be nullable
        //     $table->string('status')->nullable(); // Assuming status can be nullable
        //     $table->foreignId('added_by')->constrained('users')->onDelete('cascade'); // Assuming added_by references users table
        //     $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null'); // Assuming deleted_by references users table
        //     $table->softDeletes(); // For soft deletes, which will handle deleted_at

        //     $table->timestamps(); // Automatically creates created_at and updated_at columns
        // });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }

    protected $casts = [
        'market_on' => 'array',
        // 'photos' => 'array',
        // 'floor_plan' => 'array',
        // 'view_360' => 'array',
        // 'video_url' => 'array',
    ];

};
