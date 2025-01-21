<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory()->create([
            'role' => 'admin'
        ]);

        Role::factory()->create([
            'role' => 'user'
        ]);

        Tag::create(['name' => 'Политика']);
        Tag::create(['name' => 'Музыка']);
        Tag::create(['name' => 'Бизнес']);
        Tag::create(['name' => 'Технологии']);
        Tag::create(['name' => 'Спорт']);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'qweqweqwe',
            'role_id' => 1,
        ]);

        User::factory(30)->create();
        Post::factory(15)->create(['user_id' => 1]);
        Post::factory(15)->create();
    }
}
