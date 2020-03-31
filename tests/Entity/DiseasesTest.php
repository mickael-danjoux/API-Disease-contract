<?php


namespace App\Tests\Entity;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Disease;

class DiseasesTest extends ApiTestCase
{
    public function testGetCollection():void
    {
        $response = static::createClient()->request('GET', '/api/diseases');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(Disease::class);
    }
}