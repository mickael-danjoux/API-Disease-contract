<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\ContractedDisease;
use App\Entity\Disease;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{

    private EntityManagerInterface $em;

    private $faker;

    private array $cities = [];

    private array $diseases = [];

    private array $people = [];

    private array $contractedDiseases = [];


    /**
     * AppFixtures constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->faker = Factory::create('fr_FR');

    }

    public function load(ObjectManager $manager)
    {
        $this->createCities(50);
        $this->createDiseases();
        $this->createPeople(300);
        $this->setDiseasesToPeople();

        $this->em->flush();
    }

    public function createCities(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $city = new City();
            $city->setName($this->faker->city);
            $city->setPostCode("FR-");
            $this->cities[] = $city;
            $this->em->persist($city);
        }
    }

    public function createDiseases()
    {
        $tab = [
            "Appendicite", "Anémie aplasique",
            "Constipation", "Coqueluche", "Coxarthrose",
            "Eczéma", "Epiphysiolyse",
            "Fausse couche", "Fièvre jaune",
            "Goutte", "Grippe", "Grippe aviaire",
            "Infection urinaire",
            "Rhinopharyngite",
            "Salmonellose", "Sida/VIH"

        ];

        foreach ($tab as $item) {
            $disease = new Disease();
            $disease->setName($item);
            $this->diseases[] = $disease;
            $this->em->persist($disease);
        }
    }


    public function createPeople(int $number): void
    {
        if(! empty( $this->cities )) {
            for ($i = 0; $i < $number; $i++) {
                $person = new Person();
                $person->setFirstName($this->faker->firstName);
                $person->setLastname(($this->faker->lastName));
                $person->setGender($this->faker->boolean);
                $person->setBirthDate($this->faker->dateTimeBetween('-100years', 'now'));
                $person->setCity($this->cities[array_rand($this->cities)]);
                $this->people[] = $person;
                $this->em->persist($person);
            }
        }
    }

    public function setDiseasesToPeople()
    {
        if (!empty($this->diseases)) {
            foreach ($this->people as $person) {
                for ($i = 0; $i < random_int(0, 10); $i++) {
                    $contracted = new ContractedDisease();
                    $contracted->setContractedAt($this->faker->dateTimeBetween($person->getBirthDate(), 'now'));
                    $contracted->setDisease($this->diseases[array_rand($this->diseases)]);
                    $person->addContractedDisease($contracted);
                    $this->contractedDiseases[] = $contracted;
                    $this->em->persist($contracted);
                }
            }
        }
    }
}
