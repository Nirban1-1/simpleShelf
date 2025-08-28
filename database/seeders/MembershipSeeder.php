<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('memberships')->insert([
            ['name' => '3 Months', 'duration_months' => 3, 'price' => 500],
            ['name' => '6 Months', 'duration_months' => 6, 'price' => 900],
            ['name' => '1 Year',   'duration_months' => 12, 'price' => 1500],
            ['name' => '5 Years',  'duration_months' => 60, 'price' => 5000],
        ]);
    }
}
