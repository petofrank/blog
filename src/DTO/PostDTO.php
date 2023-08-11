<?php

namespace App\DTO;

use App\Entity\Author;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

class PostDTO
{
    /**
     * @var string
     */
    #[Assert\NotBlank]
    #[Assert\Length(min:1, max:255)]
    public string $title;

    /**
     * @var string
     */
    #[Assert\NotBlank]
    #[Assert\Length(min:10, max:255)]
    public string $content;

    /**
     * @var DateTime
     */
    #[Assert\NotBlank]
    public Datetime $date;

    /**
     * @var Author
     */
    #[Assert\NotBlank]
    public Author $author;

    /**
     * @param string $title
     * @param string $content
     * @param DateTime $date
     * @param Author $author
     */
    public function __construct(string $title, string $content, DateTime $date, Author $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->author = $author;
    }
}