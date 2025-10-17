<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Repository\PostRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Infrastructure\Persistence\Entity\PostDoctrine;
use App\Domain\Entity\Post as DomainPost;

class PostDoctrineRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, PostDoctrine::class);
    }

    public function findById(int $id): ?int
    {
        $entity = $this->find($id);
        return $entity ? $entity->getId() : null;
    }

    public function findAll(): array
    {
        $entities = parent::findAll();
        return array_map(fn(PostDoctrine $e) => $e->toDomain(), $entities);
    }

    public function save(DomainPost $post): DomainPost
    {
        $em = $this->getEntityManager();

        if ($post->getId()) {
            $postDoctrine = $this->find($post->getId());
            // map fields
        } else {
            $postDoctrine = new PostDoctrine($post);
            $em->persist($postDoctrine);
        }

        $em->flush();

        return $postDoctrine->toDomain();
    }
}
