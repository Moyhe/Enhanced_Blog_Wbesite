<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

<<<<<<< HEAD
use App\Models\Post;
use App\Models\User;
use Database\Factories\PostFactory;
=======
use App\Models\User;
>>>>>>> origin/main
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
<<<<<<< HEAD

        $adminUser = User::factory()->create([
            'email' => 'Geni@gmail.com',
            'name' => 'Geni',
            'password' => Hash::make('kenkanekiTouka123')
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminUser->assignRole($adminRole);

        PostFactory::new()->count(20)->create();
=======
        //  \App\Models\Post::factory(50)->create();
         $adminUser = User::factory()->create([
            'email' => 'Geni@gmail.com',
            'name' => 'Geni',
            'password' => Hash::make('kenkanekiTouka123')
         ]);

         $adminRole = Role::create(['name' => 'admin']);
         $adminUser->assignRole($adminRole);
>>>>>>> origin/main
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
