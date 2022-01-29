<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Actions\ToggleReactionAction;
use Facades\App\Services\JsonResponser;
use App\Http\Requests\ToggleReactionRequest;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::with(['likes', 'tags'])->get();

        $data = collect();

        $posts->each(function($post) use ($data) {
            $data->add([
                'id'          => $post->id,
                'title'       => $post->title,
                'description' => $post->description,
                'tags'        => $post->tags,
                'like_counts' => $post->likes->count(),
                'created_at'  => $post->created_at,
            ]);
        });

        return response()->json([
            'data' => $data,
        ]);
    }

    public function toggleReaction(ToggleReactionRequest $request, ToggleReactionAction $action)
    {
        $action->execute($request);

        if ($request->like) {
            $action->createLike($request);

            return JsonResponser::success200('You Liked This Post Successfully!');
        } else {
            return JsonResponser::success200('You Already Unliked This Post');
        }
    }
}
