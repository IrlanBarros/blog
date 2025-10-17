<?php

namespace App\Application\DTO;

use App\Domain\ValueObject\Post\Status;
use App\Domain\Exception\PostException;

class PostDTO
{
    private int $id;
    private string $title;
    private string $content;
    private Status $status;

    public function __construct(int $id, string $title, string $content)
    {
        if (empty($id) || empty($title) || empty($content)) {
            throw new PostException('
                The id, title and content properties cannot be empty.
            ');
        }

        $this->id = $id;
        $this->title = $title;
        $this->$content = $content;
        $this->status = Status::Draft;
    }
}
