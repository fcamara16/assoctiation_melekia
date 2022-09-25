<?php

namespace App\Repository;

use App\Entity\NotreHistoire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotreHistoire>
 *
 * @method NotreHistoire|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotreHistoire|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotreHistoire[]    findAll()
 * @method NotreHistoire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotreHistoireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotreHistoire::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(NotreHistoire $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(NotreHistoire $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return NotreHistoire[] Returns an array of NotreHistoire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotreHistoire
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
