<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractedDiseaseRepository")
 * @ApiResource(
 *     itemOperations={
 *          "get"
 *     },
 *     collectionOperations={
 *           "get",
 *           "get_count_contract_year"={
 *                  "method"="GET",
 *                  "path"="/contracted_diseases/{year}",
 *                  "controller"="App\Controller\ContractedDiseaseAction::yearInformation",
 *                  "openapi_context"={
 *                      "summary"="Retrives count contracted for one year",
 *                  },
 *                  "defaults"={"_api_receive"=false,"_api_respond"=false},
 *          },
 *     }
 * )
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="contractedDiseases", cascade={"persist"})
     */
    private $person;

    public function __construct()
    {

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
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person): void
    {
        $this->person = $person;
    }






}
