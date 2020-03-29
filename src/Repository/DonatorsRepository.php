<?php

namespace App\Repository;

use App\Entity\Donators;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Donators|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donators|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donators[]    findAll()
 * @method Donators[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonatorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donators::class);
    }

    // /**
    //  * @return Donators[] Returns an array of Donators objects
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
    public function findOneBySomeField($value): ?Donators
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
