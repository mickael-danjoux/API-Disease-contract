<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractedDiseaseRepository")
 */
class ContractedDisease
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Disease", inversedBy="contractedDiseases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $disease;

    /**
     * @ORM\Column(type="datetime")
     */
    private $contractedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="contractedDiseases")
     */
    private $people;

    public function __construct()
    {
        $this->people = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisease(): ?Disease
    {
        return $this->disease;
    }

    public function setDisease(?Disease $disease): self
    {
        $this->disease = $disease;

        return $this;
    }

    public function getContractedAt(): ?\DateTimeInterface
    {
        return $this->contractedAt;
    }

    public function setContractedAt(\DateTimeInterface $contractedAt): self
    {
        $this->contractedAt = $contractedAt;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->people->contains($person)) {
            $this->people->removeElement($person);
        }

        return $this;
    }
}
