<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Post;
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
        User::create([
            'name' => 'Failj',
            'email' => 'Failj@bk.ru',
            'password' => Hash::make('2288'),
        ]);
        EventCategory::factory()->count(10)->create();
        Category::factory()->count(80)->create();
        Post::factory()->count(1000)->create();
        Event::factory()->count(200)->create();
//        $this->call([RolesSeeder::class]);
//        $users = [
//            [
//                'name' => 'Admin',
//                'email' => 'Admin@mail.ru',
//                'password' => 'R177p900',
//                'role' => 'admin',
//            ],
//            [
//                'name' => 'John',
//                'email' => 'Test@mail.ru',
//                'password' => 'R177p900',
//                'role' => 'user',
//            ]
//        ];
//        foreach ($users as $user) {
//            $created_user = User::create([
//                'name' => $user['name'],
//                'email' => $user['email'],
//                'password' => Hash::make($user['password']),
//            ]);
//            $created_user->assignRole($user['role']);
//        }
    }
}
