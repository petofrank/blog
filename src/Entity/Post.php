<?php

namespace App\Entity;

use App\Repository\PostRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'posts')]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name:'id', type: 'integer')]
    private int|null $id;

    #[ORM\Column(name:"title", type:"string", length:255)]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(name:"content", type:"text")]
    #[Assert\NotBlank]
    private string $content;

    #[ORM\Column(name:"date", type:"datetime")]
    private DateTime $date;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Author")]
    #[ORM\JoinColumn(name:'author_id', referencedColumnName: 'id')]
    #[Assert\NotBlank]
    private Author $author;

    #[ORM\OneToMany(mappedBy: "post", targetEntity: "App\Entity\Comment")]
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->date = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    public function getContentShort(): string
    {
        return substr($this->content, 0, 10) . '...';
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
     * @return void
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
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
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }


    /**
     * @param $comments
     * @return void
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }


}
