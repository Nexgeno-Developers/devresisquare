<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('owner_group')->insert([
            [
                'property_id' => 1,
                'contact_id' => 1,
                'purchased_date' => '2024-11-27',
                'sold_date' => null,
                'archived_date' => null,
                'status' => 'active',
            ]
        ]);
    }
}
