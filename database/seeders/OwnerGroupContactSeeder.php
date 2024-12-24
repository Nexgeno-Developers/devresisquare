<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OwnerGroupContact;
use Illuminate\Database\Seeder;

class OwnerGroupContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        OwnerGroupContact::create([
            'owner_group_id' => 1, // Ensure this ID exists in your owner_groups table
            'contact_id' => 1,
            'is_main' => true,
        ]);

        OwnerGroupContact::create([
            'owner_group_id' => 1, // Again, ensure this ID exists
            'contact_id' => 2,
            'is_main' => false,
        ]);
    }
}
