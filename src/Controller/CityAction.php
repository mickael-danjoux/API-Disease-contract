<?php


namespace App\Controller;


use App\Repository\ContractedDiseaseRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CityAction
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


   public function getInformation(){
       $data = [

       ];

       $data = $this->contractRepo->countContractedByCities();
       $sentData = $this->normalizer->normalize($data);

       return new JsonResponse($sentData,200);

   }

}