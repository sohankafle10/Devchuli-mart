<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'=>'Admin',
            'email'=>'admin@lict.com',
            'password'=>bcrypt('admin123'),
            'role'=>'admin',
            'phone'=>'9800000000',
            'address'=>'Kathmandu',
            
        ]);
    }
}
