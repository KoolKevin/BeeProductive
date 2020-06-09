<?php

namespace App\Repository;

use App\Entity\Statistiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statistiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statistiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statistiche[]    findAll()
 * @method Statistiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatisticheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statistiche::class);
    }

    // /**
    //  * @return Statistiche[] Returns an array of Statistiche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Statistiche
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
