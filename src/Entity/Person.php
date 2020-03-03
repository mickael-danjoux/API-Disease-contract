<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContractedDisease", mappedBy="people")
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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