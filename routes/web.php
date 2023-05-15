<?php

use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\PostCommentController;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Post', [
        'discussion_count' => Comment::count(),
        'comments' =>  Post::query()
            ->first()
            ->comments()
            ->latest()
            ->with([
                'user',
                'replies.user',
                'replies.replies.user'
            ])
            ->get()
    ]);
});

Route::post('/posts/{post}/comment', PostCommentController::class);
Route::post('/comments/{comment}/reply', CommentReplyController::class);
