<?php

namespace App\Infrastructure\Persistence\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Persistence\Repository\PostDoctrineRepository;
use App\Domain\Entity\Post as DomainPost;
use App\Domain\ValueObject\Post\Status;

#[ORM\Entity(repositoryClass: PostDoctrineRepository::class)]
#[ORM\Table(name: 'posts')]

class PostDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'string', length: 20, enumType: Status::class, options: ['default' => Status::Draft->value])]
    private Status $status = Status::Draft;

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
        return DomainPost::fromPersistence(
            $this->getId(),
            $this->title,
            $this->content,
            $this->status
        );
    }
}
