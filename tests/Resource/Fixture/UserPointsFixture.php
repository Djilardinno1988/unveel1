<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Tests\Tools\FakerTools;
use App\Users\Domain\Entity\UserPoints;
use App\Users\Domain\Factory\UserPointsFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserPointsFixture extends Fixture
{
    use FakerTools;

    public const REFERENCE = 'user_points';

    public function __construct(private UserPointsFactory $userPointsFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        if ($this->getReference(UserFixture::REFERENCE)) {
            $userPoints = $this->userPointsFactory->create(
                [
                    [
                        'point'     => $this->getFaker()->numberBetween(1, 5),
                        'isBooster' => $this->getFaker()->boolean(),
                        'type'      => UserPoints::USER_POINTS_TYPE_DELIVERY,
                        'user'      => $this->getReference(UserFixture::REFERENCE)
                    ],
                    [
                        'point'     => $this->getFaker()->numberBetween(1, 5),
                        'isBooster' => false,
                        'type'      => UserPoints::USER_POINTS_TYPE_RIDESHARE,
                        'user'      => $this->getReference(UserFixture::REFERENCE)
                    ],
                    [
                        'point'     => $this->getFaker()->numberBetween(1, 5),
                        'isBooster' => $this->getFaker()->boolean(),
                        'type'      => UserPoints::USER_POINTS_TYPE_RENT,
                        'user'      => $this->getReference(UserFixture::REFERENCE)
                    ]
                ]
            );

            foreach ($userPoints as $userPoint) {
                $manager->persist($userPoint);
                $manager->flush();
            }
        }
    }
}
