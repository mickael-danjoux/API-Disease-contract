<?php


namespace App\Controller;


use App\Entity\Disease;
use App\Repository\ContractedDiseaseRepository;
use App\Repository\DiseaseRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Constraints\Json;

class DiseaseAction
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

    public function genderInformation(Disease $disease):JsonResponse
    {
        $data = [
            'M' => 0,
            'F' => 0,
        ];
        $contracts = $this->contractRepo->findByDisease($disease);

        foreach ( $contracts as $contract){
            if( $contract->getPerson()->getGender() == true ){
                $data['M'] ++;
            }else{
                $data['F'] ++;
            }
        }
        $sentData = $this->normalizer->normalize($data);

        return new JsonResponse($data,200);

    }

    /**
     * @param Disease $disease
     * @param string $year
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function yearInformation(Disease $disease, string $year ):JsonResponse
    {
        $data = [
            "year" => $year,
            "disease" => $disease->getName(),
            "count" => 0
        ];

        $data["count"] = count($this->contractRepo->findByDate($year,$disease));
        $sentData = $this->normalizer->normalize($data);

        return new JsonResponse($sentData,200);

    }

    public function contractedByYearInformation(Disease $disease):JsonResponse
    {

        $data = [
            "disease" => $disease->getName(),
            "contractedAt" => []
        ];

        $data["contractedAt"] =  $this->contractRepo->findByDiseaseOrderByYears($disease);

        $sentData = $this->normalizer->normalize($data);
        return new JsonResponse($sentData,200);
    }

}