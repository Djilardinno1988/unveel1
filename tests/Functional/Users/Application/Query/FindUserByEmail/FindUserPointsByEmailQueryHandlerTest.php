<?php

declare(strict_types=1);

namespace App\Tests\Functional\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\UserFixture;
use App\Tests\Resource\Fixture\UserPointsFixture;
use App\Users\Application\Query\FindUserByEmail\FindUserPointByEmailQuery;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Entity\UserPoints;
use DateTime;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindUserPointsByEmailQueryHandlerTest extends WebTestCase
{
    private QueryBusInterface $queryBus;
    private AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->queryBus = $this::getContainer()->get(QueryBusInterface::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_user_points_when_command_executed(): void
    {
        // arrange
        $referenceRepository = $this->databaseTool->loadFixtures([UserFixture::class])->getReferenceRepository();
        $this->databaseTool->loadFixtures([UserPointsFixture::class])->getReferenceRepository();
        /** @var User $user */
        $user = $referenceRepository->getReference(UserFixture::REFERENCE);
        $query = new FindUserPointByEmailQuery($user->getEmail());

        // act
        $userPoints = $this->queryBus->execute($query);

        // assert
        $this->assertEquals($this->calculateUserPoints($user), $userPoints);
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
