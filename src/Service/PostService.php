<?php

namespace App\Service;

use App\DTO\PostDTO;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostService
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
     * @param PostDTO $postDTO
     * @return Post
     */
    public function createPost(PostDTO $postDTO): Post
    {
        $post = new Post();
        $post->setTitle($postDTO->title);
        $post->setContent($postDTO->content);
        $post->setDate($postDTO->date);
        $post->setAuthor($postDTO->author);

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }
}