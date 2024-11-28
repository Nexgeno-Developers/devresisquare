<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactCategory;

class ContactCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ContactCategory::create(['name' => 'Owner', 'status' => 1]);
        ContactCategory::create(['name' => 'Property Manager', 'status' => 1]);
        ContactCategory::create(['name' => 'Tenant', 'status' => 1]);
        ContactCategory::create(['name' => 'Landlord', 'status' => 1]);
        ContactCategory::create(['name' => 'Agent', 'status' => 1]);
        ContactCategory::create(['name' => 'Contractor', 'status' => 1]);
        ContactCategory::create(['name' => 'Maintenance', 'status' => 1]);
        ContactCategory::create(['name' => 'Service Provider', 'status' => 1]);
    }
}
