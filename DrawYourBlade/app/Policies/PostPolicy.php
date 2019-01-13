<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Closure;

class PostPolicy
{
    use HandlesAuthorization;

//    public function handle($request, Closure $next)
//
//    {
//        $postID = $request->postID;
//
//        $requestingUser = Auth::user() -> id;
//        $post = Post::find($postID);
//
//        if($requestingUser == $post->creatorID){
//            return $next($request);
//        }
//
//
//        return redirect('/');
//    }

 /*   public function owner(User $user, Post $post)
    {
        return $user->id === $post->creatorID;
    } */
	
	/**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
		if($user->type == 'admin' || $user->type == 'editor' || $user->id == $post->creatorID){
			return true;
		}
		
		return false;;
    }

    public function delete(User $user, Post $post)
    {
        if($user->type == 'admin' || $user->id == $post->creatorID){
            return true;
        }

        return false;;
    }


}
