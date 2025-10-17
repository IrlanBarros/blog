<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Post\Status;
use App\Domain\Exception\PostException;

class Post
{
    private ?int $id = null;
    private string $title;
    private string $content;
    private Status $status;

    public function __construct(string $title, string $content)
    {
        $this->setTitle($title);
        $this->setContent($content);
        $this->status = Status::Draft;
    }

    /**
     * @return int post id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string post title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string post content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return Status post status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * Update post title
     * @return self updated post
     */
    public function updateTitle(string $title): self
    {
        $this->setTitle($title);
        return $this;
    }

    /**
     * Update post content
     * @return self updated post
     */
    public function updateContent(string $content): self
    {
        $this->setContent($content);
        return $this;
    }

    /**
     * Update post status
     * @return self updated post
     */
    public function updateStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }

    private function setTitle(string $title): void
    {
        if (empty($title)) {
            throw new PostException('Property title cannot be empty');
        }

        $this->title = $title;
    }

    private function setContent(string $content): void
    {
        if (empty($content)) {
            throw new PostException('Property content cannot be empty');
        }

        $this->content = $content;
    }

    /**
     * Publish post
     * @return void
     */
    public function publish(): void
    {
        $this->status = $this->status::Published;
    }

    /**
     * Update entity after persistence
     * @return self
     */
    public static function fromPersistence(
        ?int $id, 
        string $title, 
        string $content, 
        Status $status
    ): self
    {
        $post = new self($title, $content);
        $post->id = $id;
        $post->status = $status;
        return $post;
    }
}
