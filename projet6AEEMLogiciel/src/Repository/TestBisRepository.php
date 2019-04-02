<?php

namespace App\Repository;

use App\Entity\TestBis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TestBis|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestBis|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestBis[]    findAll()
 * @method TestBis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestBisRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TestBis::class);
    }

    // /**
    //  * @return TestBis[] Returns an array of TestBis objects
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
    public function findOneBySomeField($value): ?TestBis
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
