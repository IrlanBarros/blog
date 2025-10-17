<?php

namespace App\Application\UseCase\Post;

use App\Domain\Repository\PostRepositoryInterface;
use App\Domain\Entity\Post;
use App\Application\DTO\PostDTO;

class CreatePostUseCase
{
    private PostRepositoryInterface $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Post $post): Post
    {
        $saved_post = $this->repository->save($post);

        // return new PostDTO(
        //     $saved_post->getId(),
        //     $saved_post->getTitle(),
        //     $saved_post->getContent()
        // );

        return $saved_post;
    }
}