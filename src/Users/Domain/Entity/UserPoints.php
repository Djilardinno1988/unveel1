<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use DateTimeInterface;

class UserPoints
{
    public const USER_POINTS_TYPE_DELIVERY = 'delivery';
    public const USER_POINTS_TYPE_RIDESHARE = 'rideshare';
    public const USER_POINTS_TYPE_RENT = 'rent';

    private string $ulid;
    private string $type;
    private bool $is_booster;
    private User $user_id;
    private int $point;
    private DateTimeInterface $created;

    public function __construct()
    {
        $this->ulid = UlidService::generate();
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBooster(): bool
    {
        return $this->is_booster;
    }

    public function getUser()
    {
        return $this->user_id;
    }

    public function getPoint(): int
    {
        return $this->point;
    }

    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(DateTimeInterface $created): void
    {
        $this->created = $created;
    }

    public function setIsBooster(bool $is_booster): void
    {
        $this->is_booster = $is_booster;
    }

    public function setPoint(int $point): void
    {
        $this->point = $point;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setUser(User $user): void
    {
        $this->user_id = $user;
    }
}
