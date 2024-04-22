<?php

namespace Database\Seeders;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class messagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Messages::factory()->count(30)->create(); 

        $admin = User::where('email', 'admin@admin.com')->first();
        
        $recipient = User::where('email',"!=", 'admin@admin.com')->get();

        foreach ($recipient as $key) {

            Messages::factory()->withRecipient($key)->withRecipient($admin)->create();
        
        }




    }
}
