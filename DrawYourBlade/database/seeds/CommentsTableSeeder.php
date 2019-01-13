<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment;
        $comment->commentContent = 'this is not so bad';
        $comment->postID = 1;
        $comment->commentAuthorID = 2;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'why you have to be so rude';
        $comment->postID = 1;
        $comment->commentAuthorID = 1;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'i liek the story';
        $comment->postID = 2;
        $comment->commentAuthorID = 2;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'sorry for bad english';
        $comment->postID = 2;
        $comment->commentAuthorID = 2;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'interesting shading';
        $comment->postID = 3;
        $comment->commentAuthorID = 2;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'this is too casual cmon';
        $comment->postID = 4;
        $comment->commentAuthorID = 1;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'the story let me down';
        $comment->postID = 5;
        $comment->commentAuthorID = 1;
        $comment->save();

        $comment = new Comment;
        $comment->commentContent = 'nice name i guess';
        $comment->postID = 5;
        $comment->commentAuthorID = 1;
        $comment->save();
    }
}
