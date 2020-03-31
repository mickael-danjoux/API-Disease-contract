<?php


namespace App\Tests\Entity;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\ContractedDisease;

class ContractedDiseasesTest extends ApiTestCase
{
    public function testGetCollection():void
    {
        $response = static::createClient()->request('GET', '/api/contracted_diseases');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(ContractedDisease::class);
    }

    public function testInformationsByYear():void
    {
        $response = static::createClient()->request('GET', '/api/contracted_diseases/information/2019');
        $this->assertResponseIsSuccessful();

    }

}