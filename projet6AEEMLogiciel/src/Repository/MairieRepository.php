<?php

namespace App\Repository;

use App\Entity\Mairie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mairie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mairie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mairie[]    findAll()
 * @method Mairie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MairieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mairie::class);
    }

    // /**
    //  * @return Mairie[] Returns an array of Mairie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mairie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
