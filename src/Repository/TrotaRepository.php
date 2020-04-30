<?php

namespace App\Repository;

use App\Entity\Trota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trota[]    findAll()
 * @method Trota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trota::class);
    }

    // /**
    //  * @return Trota[] Returns an array of Trota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trota
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
