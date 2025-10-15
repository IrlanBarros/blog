<?php

namespace App\Infrastructure\Persistent\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\Post as DomainPost;
use App\Domain\ValueObject\Post\Status;
use App\Infrastructure\Persistent\Repository\PostRepository;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'posts')]

class PostDb
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'string', length: 20, enumType: Status::class, options: ['default' => Status::draft->value])]
    private Status $status = Status::draft;

    public function __construct(DomainPost $post)
    {
        $this->title = $post->getTitle();
        $this->content = $post->getContent();
        $this->status = $post->getStatus();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function toDomain(): DomainPost
    {
        return new DomainPost($this->title, $this->content, $this->status);
    }
}
