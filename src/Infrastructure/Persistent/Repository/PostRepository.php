<?php

namespace App\Infrastructure\Persistent\Repository;


use App\Domain\Entity\Post as DomainPost;
use App\Domain\Repository\PostRepositoryInterface;
use App\Infrastructure\Persistence\Entity\PostDb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function save()
    {
        // 
    } 

    public function findById(int $id): ?DomainPost
    {
        // 
    }

    public function findAll(): array
    {
        // 
    }
}