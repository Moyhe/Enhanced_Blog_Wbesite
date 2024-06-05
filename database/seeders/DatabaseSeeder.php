<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\TextWidget;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /** @var \App\Models\User $adminUser */
    public function run(): void
    {

        $adminUser = User::factory()->create([
            'email' => 'Geni@gmail.com',
            'name' => 'Geni',
            'password' => Hash::make('kenkanekiTouka123')
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminUser->assignRole($adminRole);


        Category::factory()
            ->count(3)
            ->hasAttached(Post::factory()->count(5))
            ->create();


        TextWidget::factory()->count(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
