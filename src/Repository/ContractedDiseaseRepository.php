<?php

namespace App\Repository;

use App\Entity\ContractedDisease;
use App\Entity\Disease;
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

    public function findByDate($year = null, Disease $disease)
    {

        if ($year === null) {
            $year = (int) date('Y');
        }

        $startDate = new \DateTime("$year-01-01");
        $endDate = new \DateTime("$year-12-31");


        $qb = $this->createQueryBuilder('object');
        $qb->where('object.contractedAt BETWEEN :start AND :end' );
        $qb->andWhere('object.disease = :disease');
        $qb->setParameter('disease', $disease);
        $qb->setParameter('start', $startDate);
        $qb->setParameter('end', $endDate);


        return $qb->getQuery()->getResult();
    }

    public function findByDiseaseOrderByYears( Disease $disease)
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = "SELECT count(id) as count, strftime('%Y',contracted_at) as year FROM contracted_disease WHERE disease_id = :id ";
        $sql .= "GROUP BY year ";
        $sql .= "ORDER BY year";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', $disease->getId());
        $stmt->execute();
        return $stmt->fetchAll();
    }



}
