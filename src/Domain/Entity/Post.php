<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Post\Status;
use App\Application\Exception\Post\{
    EmptyPostFieldException
};

class Post
{
    private ?int $id;
    private string $title;
    private string $content;
    private ?int $author_id;
    private Status $status = Status::draft;

    public function __construct(
        string $title,
        string $content
    ) {
        if (empty(trim($title))) {
            throw new EmptyPostFieldException('title');
        }

        if (empty(trim($content))) {
            throw new EmptyPostFieldException('content');
        }

        $status = Status::draft;

        $this->id = null;
        $this->author_id = null;
        $this->title = $title;
        $this->content = $content;
        $this->status = $status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getStatusValue(): string
    {
        return $this->status->value;
    }
}
