<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactDetail;

class ContactDetailsSeeder extends Seeder
{
       /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactDetail::create([
            'contact_id' => 1,
            'employment_status' => 'Employed',
            'business_name' => 'Tech Solutions',
            'guarantee' => true,
            'previously_rented' => true,
            'poor_credit' => false,
        ]);

        ContactDetail::create([
            'contact_id' => 2,
            'employment_status' => 'Self Employed',
            'business_name' => 'Freelance Artist',
            'guarantee' => false,
            'previously_rented' => false,
            'poor_credit' => true,
        ]);
    }
}
