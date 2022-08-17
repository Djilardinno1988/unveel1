<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Users\Domain\Entity\UserPoints;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Domain\Entity\User;
use DateTime;

class FindUserPointsByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(FindUserByEmailQuery $query): int
    {
        $user = $this->userRepository->findByEmail($query->email);

        if (!$user) {
            throw new \Exception('User not found');
        }

        return $this->calculateUserPoints($user);
    }

    private function calculateUserPoints(User $user): int
    {
        $sumPointAmount = 0;
        $dateCompareDate = new DateTime();
        $dateCompareDate->modify('-1 month');

        /** @var UserPoints $point */
        foreach ($user->getPoints() as $point) {
            if (!$point->getBooster() and !($point->getCreated() > $dateCompareDate)) {
                continue;
            }

            $sumPointAmount += $point->getPoint();
        }

        return $sumPointAmount;
    }
}
