<?php

namespace App\Repository;

use App\Entity\ContractedDisease;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractedDisease|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractedDisease|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractedDisease[]    findAll()
 * @method ContractedDisease[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractedDiseaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractedDisease::class);
    }

    // /**
    //  * @return ContractedDisease[] Returns an array of ContractedDisease objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContractedDisease
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
