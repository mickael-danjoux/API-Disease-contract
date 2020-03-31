<?php


namespace App\Tests\Entity;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\City;

class CitiesTest extends ApiTestCase
{
    public function testGetCollection():void
    {
        $response = static::createClient()->request('GET', '/api/cities');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(City::class);
    }

    public function testCount():void
    {
        $response = static::createClient()->request('GET', '/api/cities/information');
        $this->assertResponseIsSuccessful();

    }
}