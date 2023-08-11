<?php

namespace App\Service;

use App\DTO\CommentDTO;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param CommentDTO $commentDTO
     * @return Comment
     */
    public function createComment(CommentDTO $commentDTO): Comment
    {
        $comment = new Comment();
        $comment->setContent($commentDTO->content);
        $comment->setAuthor($commentDTO->author);
        $comment->setPost($commentDTO->post);
        $comment->setDate($commentDTO->date);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return $comment;
    }
}