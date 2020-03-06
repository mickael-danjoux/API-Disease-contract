<?php


namespace App\Controller;


use App\Entity\Disease;
use App\Repository\ContractedDiseaseRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContractedDiseaseAction
{

    /**
     * @var NormalizerInterface
     */
    private NormalizerInterface $normalizer;
    /**
     * @var ContractedDiseaseRepository
     */
    private ContractedDiseaseRepository $contractRepo;


    /**
     * DiseaseAction constructor.
     * @param NormalizerInterface $normalizer
     * @param ContractedDiseaseRepository $contractRepo
     */
    public function __construct(NormalizerInterface $normalizer, ContractedDiseaseRepository $contractRepo)
    {

        $this->normalizer = $normalizer;
        $this->contractRepo = $contractRepo;
    }

    public function yearInformation(string $year ):JsonResponse
    {
        $data = [
            "year" => $year,
            "count" => 0
        ];

        $data["count"] = count($this->contractRepo->findByDate($year));
        $sentData = $this->normalizer->normalize($data);

        return new JsonResponse($sentData,200);

    }

}