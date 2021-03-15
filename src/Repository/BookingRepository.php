<?php

namespace App\Repository;

use App\Entity\Booking;
use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByDate(Booking $booking): bool
{
    $roomId= $booking->getRoom()->getId();
    $date_one=$booking->getDateIn();
    $date_two=$booking->getDateOut();

    $arr_bookings = $this->createQueryBuilder('b')
        ->andWhere('b.room = :roomId')
        ->andWhere('b.date_in > :date_one AND b.date_in < :date_two') /*or 'b.date_in = :date_one' )*/
        ->orWhere('b.date_in = :date_one')
        ->andWhere('b.date_out < :date_two AND b.date_out > :date_one') /*or 'b.date_out = :date_two' )*/
        ->orWhere('b.date_in = :date_one')
        ->setParameter('date_one',$date_one)
        ->setParameter('date_two',$date_two)
        ->setParameter('roomId',$roomId)
        ->getQuery()
        ->getResult();
    if (empty($arr_bookings)){
        return false;
    }
    else{
        return true;
    }
}
}

