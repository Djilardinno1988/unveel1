<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryInterface;

class FindUserPointByEmailQuery implements QueryInterface
{
    public function __construct(public string $email)
    {
    }
}
