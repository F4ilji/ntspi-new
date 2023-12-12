<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RolesSeeder::class]);
        $users = [
            [
                'name' => 'Admin',
                'email' => 'Admin@mail.ru',
                'password' => 'R177p900',
                'role' => 'admin',
            ],
            [
                'name' => 'John',
                'email' => 'Test@mail.ru',
                'password' => 'R177p900',
                'role' => 'user',
            ]
        ];
        foreach ($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
            $created_user->assignRole($user['role']);
        }
    }
}
