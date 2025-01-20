<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'role' => 1,
            'phone_number' => 123456789,
            'notification_token' => '',
            'program_assigned'  => '0'
        ]);
    }
}
