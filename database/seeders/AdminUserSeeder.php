<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dribbling.com'],
            [
                'name' => 'NotMunthasir',
                'phone' => null,
                'password' => Hash::make('191852'),
                'role' => 'superadmin',
                'status' => true,
            ]
        );
    }
}
