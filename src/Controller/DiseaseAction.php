<?php


namespace App\Controller;


use App\Entity\Disease;
use App\Repository\ContractedDiseaseRepository;
use App\Repository\DiseaseRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DiseaseAction
{

    public function genderInformation(Disease $disease,  ContractedDiseaseRepository $contractRepo, NormalizerInterface $normalizer):JsonResponse
    {
        $data = [
            'M' => 0,
            'F' => 0,
        ];

        $contracts = $contractRepo->findByDisease($disease);

        foreach ( $contracts as $contract){
            if( $contract->getPerson()->getGender() === 1 ){
                $data['M'] ++;
            }else{
                $data['F'] ++;
            }
        }

        $sentData = $normalizer->normalize($data);

        return new JsonResponse($data,200);

    }

}