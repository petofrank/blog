<?php

namespace App\DTO;

use App\Entity\Author;
use App\Entity\Post;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class CommentDTO
{
    /**
     * @var string
     */
    #[Assert\NotBlank]
    #[Assert\Length(min:1, max:255)]
    public string $content;

    /**
     * @var DateTime
     */
    #[Assert\NotBlank]
    public DateTime $date;

    /**
     * @var Post
     */
    #[Assert\NotBlank]
    public Post $post;

    /**
     * @var Author
     */
    #[Assert\NotBlank]
    public Author $author;

    /**
     * @param string $content
     * @param DateTime $date
     * @param Post $post
     * @param Author $author
     */
    public function __construct(string $content, DateTime $date, Post $post, Author $author)
    {
        $this->content = $content;
        $this->date = $date;
        $this->post = $post;
        $this->author = $author;
    }
}