<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\ContactCategory;

class ContactsSeeder extends Seeder
{
    public function run()
    {
        // Seed categories using the ContactCategory model
        // $ownerCategory = ContactCategory::create(['name' => 'Owner', 'status' => 1]);
        // $managerCategory = ContactCategory::create(['name' => 'Property Manager', 'status' => 1]);

        // Seed contacts using the Contact model
        Contact::create([
            'category_id' => 1,
            'first_name' => 'John',
            'middle_name' => 'A.',
            'last_name' => 'Doe',
            'full_name' => 'John A. Doe',
            'phone' => '1234567890',
            'email' => 'john.doe@example.com',
            'address_line_1' => '123 Main Street',
            'address_line_2' => 'Apt 4B',
            'postcode' => '12345',
            'city' => 'New York',
            'country' => 'USA',
            'status' => 1,
            'updated_by' => 1,
        ]);

        Contact::create([
            'category_id' => 2,
            'first_name' => 'Jane',
            'middle_name' => null,
            'last_name' => 'Smith',
            'full_name' => 'Jane Smith',
            'phone' => '9876543210',
            'email' => 'jane.smith@example.com',
            'address_line_1' => '456 Elm Street',
            'address_line_2' => null,
            'postcode' => '54321',
            'city' => 'Los Angeles',
            'country' => 'USA',
            'status' => 1,
            'updated_by' => 2,
        ]);
    }
}
