<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(Photo::factory()->count(5), 'photos')
            ->has(Comment::factory()->count(10), 'comments')
            ->count(10)
            ->create();
    }
}
