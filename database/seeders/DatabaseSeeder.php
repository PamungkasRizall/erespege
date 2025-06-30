<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Rizal Pamungkas',
            'username' => 'super.admin',
            'nip' => '919930207201911101',
            'phone' => '6281288616004',
            'password' => bcrypt('123456'),
        ]);
    }
}
