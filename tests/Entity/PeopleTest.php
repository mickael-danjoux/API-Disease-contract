<?php


namespace App\Tests\Entity;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Person;

class PeopleTest extends ApiTestCase
{
    public function testGetCollection():void
    {
        $response = static::createClient()->request('GET', '/api/people');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(Person::class);
    }
}