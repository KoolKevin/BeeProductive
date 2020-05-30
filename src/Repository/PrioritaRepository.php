<?php

namespace App\Repository;

use App\Entity\Priorita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Priorita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Priorita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Priorita[]    findAll()
 * @method Priorita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrioritaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Priorita::class);
    }

    // /**
    //  * @return Priorita[] Returns an array of Priorita objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Priorita
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Priorita[]
     */
    public function getAllPriorita(): array
    {
        /*$entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
              FROM App\Entity\Eventi e, App\Entity\User u
              WHERE u.id = e.fk_id_utente, e.fk_id_utente = :userId
              ORDER BY e.priorita, e.id ASC'
        )->setParameter('userId', $userId);

        // returns an array of Product objects
        return $query->getResult();
*/
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM priorita ORDER BY id ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
