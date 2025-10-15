<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Post;

interface PostRepositoryInterface
{
    public function save(Post $post): ?Post;
    public function findById(int $id): ?Post;
    public function findAll(): ?array;
}