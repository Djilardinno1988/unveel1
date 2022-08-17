<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckActionTest extends WebTestCase
{
    public function test_a()
    {
        $client = static::createClient();
        $client->request('GET', 'health-check');

        $this->assertResponseIsSuccessful();
    }
}
