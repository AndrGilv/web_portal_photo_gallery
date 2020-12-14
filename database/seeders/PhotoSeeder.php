<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Photo::factory()
            ->has(Comment::factory()->count(5), 'comments')
            ->for(User::factory(), 'user')
            ->for(Category::factory(), 'category')
            ->count(100)
            ->create();
    }
}
