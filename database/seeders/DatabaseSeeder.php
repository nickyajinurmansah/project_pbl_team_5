<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

   

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'password' => '123',
        //     'role' => 'Admin', 
        // ]);

        User::create([
            'username' => 'admin',           // ✅ Kolom username (bukan 'name')
            'password' => 'admin123', // ✅ Password WAJIB di-hash!
            'role' => 'Admin',               // ✅ Sesuai kolom role
            'status' => 'Aktif',             // ✅ Sesuai kolom status
        ]);
    }
}
