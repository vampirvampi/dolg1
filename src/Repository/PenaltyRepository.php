<?php

namespace App\Repository;

use App\Entity\Penalty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Penalty|null find($id, $lockMode = null, $lockVersion = null)
 * @method Penalty|null findOneBy(array $criteria, array $orderBy = null)
 * @method Penalty[]    findAll()
 *
 * @method Penalty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PenaltyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Penalty::class);
    }

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('num_car')
            ->andWhere('num_car.number = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Penalty
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
