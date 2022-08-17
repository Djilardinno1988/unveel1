<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;

interface UserPointsRepositoryInterface
{
    public function findPointsByUserEmailByDate(string $userId): ?int;
}
