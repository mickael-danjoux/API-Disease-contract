<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ApiResource(
 *     normalizationContext={
 *         "groups"={"people_read"}
 *     },
 *     itemOperations={
 *          "get"
 *     },
 *     collectionOperations={
 *           "get"
 *     }
 * )
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"people_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"people_read"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"people_read"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"people_read"})
     */
    private $gender;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"people_read"})
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"people_read"})
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractedDisease", mappedBy="person", cascade={"persist"})
     * @ApiSubresource()
     */
    private $contractedDiseases;

    public function __construct()
    {
        $this->contractedDiseases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|ContractedDisease[]
     */
    public function getContractedDiseases(): Collection
    {
        return $this->contractedDiseases;
    }

    public function addContractedDisease(ContractedDisease $contractedDisease): self
    {
        if (!$this->contractedDiseases->contains($contractedDisease)) {
            $this->contractedDiseases[] = $contractedDisease;
            $contractedDisease->addPerson($this);
        }

        return $this;
    }

    public function removeContractedDisease(ContractedDisease $contractedDisease): self
    {
        if ($this->contractedDiseases->contains($contractedDisease)) {
            $this->contractedDiseases->removeElement($contractedDisease);
            $contractedDisease->removePerson($this);
        }

        return $this;
    }
}
