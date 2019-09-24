<?php

declare(strict_types=1);

namespace App\Tests\Controller\Workshop;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListControllerTest extends WebTestCase
{
    public function test_it_should_return_a_list_of_workshops(): void
    {
        $client = static::createClient();
        $client->request('GET', '/workshops');

        static::assertResponseIsSuccessful();

        $json = $client->getResponse()->getContent();

        static::assertSame('[]', $json);
    }
}
