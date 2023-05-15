<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostCommentController extends Controller
{
    public function __invoke(Post $post, Request $request)
    {
        $faker = Factory::create();

        $user = User::create([
            'name' => $faker->name(),
        ]);

        $post->comments()->create([
            'user_id' => $user->id,
            'body' => $request->comment,
        ]);
    }
}
