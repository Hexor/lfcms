<?php


namespace LFPackage\Comment;

use LFPackage\Comment\Repositories\CommentRepositoryInterface;

class LFComment
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getCommentsData($target_id)
    {
        $comments = $this->commentRepository->getComments($target_id);

        $result = [
            'comments' => $comments,
            'target_id' => $target_id
        ];
        return $result;
    }
}