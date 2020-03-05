<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @todo
 */

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiseaseRepository")
 * @ApiResource(
 *      itemOperations={
 *          "get",
 *          "get_informations_gender"={
 *                  "method"="GET",
 *                  "path"="/diseases/{id}/information/gender",
 *                  "controller"="App\Controller\DiseaseAction::genderInformation",
 *                  "openapi_context"={
 *                      "summary"="Retrives informations about a disease",
 *                  },
 *                  "defaults"={"_api_receive"=false,"_api_respond"=false},
 *          },
 *         "get_informations_contract_all_years"={
 *                  "method"="GET",
 *                  "path"="/diseases/{id}/information/contracted_by_year",
 *                  "controller"="App\Controller\DiseaseAction::contractedByYearInformation",
 *                  "openapi_context"={
 *                      "summary"="Retrives informations about a disease",
 *                  },
 *                  "defaults"={"_api_receive"=false,"_api_respond"=false},
 *          },
 *         "get_informations_contract_year"={
 *                  "method"="GET",
 *                  "path"="/diseases/{id}/information/{year}",
 *                  "controller"="App\Controller\DiseaseAction::yearInformation",
 *                  "openapi_context"={
 *                      "summary"="Retrives informations about a disease",
 *                  },
 *                  "defaults"={"_api_receive"=false,"_api_respond"=false},
 *          },
 *     },
 *     collectionOperations={
 *           "get"
 *     }
 * )
 */
class Disease
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractedDisease", mappedBy="disease")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $contractedDisease->setDisease($this);
        }

        return $this;
    }

    public function removeContractedDisease(ContractedDisease $contractedDisease): self
    {
        if ($this->contractedDiseases->contains($contractedDisease)) {
            $this->contractedDiseases->removeElement($contractedDisease);
            // set the owning side to null (unless already changed)
            if ($contractedDisease->getDisease() === $this) {
                $contractedDisease->setDisease(null);
            }
        }

        return $this;
    }
}
