<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\UserPoints;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class UserPointsFactory
{
    public function __construct()
    {
    }

    public function create(array $userPoints): ArrayCollection
    {
        $userPointsCollection = new ArrayCollection();
        foreach ($userPoints as $userPoint) {
            $userPointObject = new UserPoints();
            $userPointObject->setIsBooster($userPoint['isBooster']);
            $userPointObject->setCreated((new DateTime()));
            $userPointObject->setPoint($userPoint['point']);
            $userPointObject->setType($userPoint['type']);
            $userPointObject->setUser($userPoint['user']);
            $userPointsCollection->add($userPointObject);
        }

        return $userPointsCollection;
    }
}
