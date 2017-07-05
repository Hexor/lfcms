<?php
namespace LFPackage\Comment\Repositories;

use LFPackage\Comment\Comment;

class CommentRepository implements CommentRepositoryInterface
{

    public function getComments($targetID, $targetTypeID = null)
    {
        $result = Comment::where('target_id', $targetID);

        if (!is_null($targetTypeID)) {
            $result = $result->where('target_type_id', $targetTypeID);
        }

        $result = $result->get();

        return $result;
    }

    public function createComment($content, $detail = null)
    {
        $comment = new Comment();
        $comment->content = $content;

        foreach ($detail as $key=>$value) {
           $comment->$key = $value;
        }

        $comment->save();

        return true;
    }
}