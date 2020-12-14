<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()
            ->for(Photo::factory(), 'photo')
            ->for(User::factory(), 'user')

            ->count(30)

            ->create();
    }
}
