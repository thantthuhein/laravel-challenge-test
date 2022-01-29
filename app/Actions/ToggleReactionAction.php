<?php

namespace App\Actions;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Facades\App\Services\JsonResponser;
use App\Exceptions\ToggleReactionException;

class ToggleReactionAction {
     public function execute(Request $request)
     {
          $post = Post::find($request->post_id);

          if (! $post) {
               throw new ToggleReactionException(
                    JsonResponser::notFound404('Post Not Found!')
               );
          }

          if ($post->user_id == auth()->id()) {
               throw new ToggleReactionException(
                    JsonResponser::serverError500('You Cannot Like Your Post!')
               );
          }

          $like = Like::where('post_id', $request->post_id)
                    ->where('user_id', auth()->id())
                    ->first();

          if ($like && $like->post_id == $request->post_id && $request->like) {
               throw new ToggleReactionException(
                    JsonResponser::serverError500('You Already Liked This Post!')
               );
          } elseif ($like && $like->post_id == $request->post_id && !$request->like) {
               $like->delete();

               throw new ToggleReactionException(
                    JsonResponser::success200('You Unliked This Post Successfully!')
               );
          }
     }

     public function createLike($request)
     {
          Like::create([
               'post_id' => $request->post_id,
               'user_id' => auth()->id()
          ]);
     }
}