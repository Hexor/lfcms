<?php
namespace LFPackage\Comment\Repositories;

interface CommentRepositoryInterface
{
    public function getComments($targetID, $targetTypeID);
    public function createComment($content, $detail);
}