<?php

namespace App\Repository;

use App\Entity\RestaurantTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @extends ServiceEntityRepository<RestaurantTable>
 */
class RestaurantTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantTable::class);
    }

    /**
     * @return RestaurantTable[] 
     */
    public function findAvailableTables(\DateTimeInterface $reservationDate, \DateTimeInterface $reservationTime): array
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('App\Entity\Reservation', 'r', Join::WITH, 't.id = r.tableId AND r.reservationDate = :reservationDate AND r.reservationTime = :reservationTime')
            ->where('r.id IS NULL')
            ->setParameter('reservationDate', $reservationDate)
            ->setParameter('reservationTime', $reservationTime)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}