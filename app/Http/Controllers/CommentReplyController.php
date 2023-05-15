<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;

class CommentReplyController extends Controller
{
    public function __invoke(Comment $comment, Request $request)
    {
        $faker = Factory::create();

        $user = User::create([
            'name' => $faker->name(),
        ]);

        $post = Post::first();

        $post->comments()->create([
            'user_id' => $user->id,
            'parent_id' => $comment->id,
            'body' => $request->reply,
        ]);
    }
}
