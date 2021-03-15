<?php

namespace App\Repository;

use App\Entity\Otel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Otel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Otel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Otel[]    findAll()
 * @method Otel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Otel::class);
    }

    // /**
    //  * @return Otel[] Returns an array of Otel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Otel
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
