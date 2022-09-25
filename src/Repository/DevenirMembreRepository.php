<?php

namespace App\Repository;

use App\Entity\DevenirMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevenirMembre>
 *
 * @method DevenirMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevenirMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevenirMembre[]    findAll()
 * @method DevenirMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevenirMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevenirMembre::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DevenirMembre $entity, bool $flush = true): void
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
    public function remove(DevenirMembre $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return DevenirMembre[] Returns an array of DevenirMembre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DevenirMembre
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
