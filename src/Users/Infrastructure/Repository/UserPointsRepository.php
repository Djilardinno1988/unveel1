<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Entity\UserPoints;
use App\Users\Domain\Repository\UserPointsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserPointsRepository extends ServiceEntityRepository implements UserPointsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPoints::class);
    }

    public function findPointsByUserEmailByDate(string $email): ?int
    {
    }
}
