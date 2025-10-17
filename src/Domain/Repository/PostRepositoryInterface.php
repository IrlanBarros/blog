<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): ?int;
    public function findAll(): array;
    public function save(Post $post): Post;
}