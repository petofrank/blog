<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: 'comments')]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name:'id', type: 'integer')]
    private int|null $id;

    #[ORM\Column(name:"content", type:"text")]
    private string $content;

    #[ORM\Column(name:"date", type:"datetime", length:255)]
    private DateTime $date;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Post", inversedBy: "comments")]
    #[ORM\JoinColumn(name:'post_id', referencedColumnName: 'id')]
    private Post $post;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Author")]
    #[ORM\JoinColumn(name:'author_id', referencedColumnName: 'id')]
    private Author $author;

    public function __construct()
    {
        $this->date = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return date_format($this->date, 'Y-m-d H:i:s');
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return void
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }
}
