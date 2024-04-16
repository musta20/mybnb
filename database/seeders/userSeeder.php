<?php

namespace Database\Seeders;

use App\Enums\HostType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'type' => HostType::HOST->value,
            'password' => Hash::make('password'),
        ]);
        User::factory()->count(10)->create(); 
    }
}
