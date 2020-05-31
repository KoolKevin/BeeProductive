<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Eventi[]
     */
    public function getEventiAttiviUtenteConPriorita($userId): array
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
            SELECT e.* FROM eventi e, user u
            WHERE u.id = e.fk_id_utente_id AND e.fk_id_utente_id = :userId AND e.completato = 0
            ORDER BY e.priorita, e.id ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['userId' => $userId]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function getEventiCompletatiUtenteConPriorita($userId): array
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
            SELECT e.* FROM eventi e, user u
            WHERE u.id = e.fk_id_utente_id AND e.fk_id_utente_id = :userId AND e.completato = 1
            ORDER BY e.priorita, e.id ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['userId' => $userId]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
