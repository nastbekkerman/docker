<?php

namespace App\Repository;

use App\Entity\Regenerat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Regenerat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regenerat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regenerat[]    findAll()
 * @method Regenerat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegeneratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Regenerat::class);
    }

    // /**
    //  * @return Regenerat[] Returns an array of Regenerat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Regenerat
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
