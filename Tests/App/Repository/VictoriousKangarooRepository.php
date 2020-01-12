<?php

namespace Iad\Bundle\DbDecorationBundle\Tests\App\Repository;

use Iad\Bundle\DbDecorationBundle\Tests\App\Entity\VictoriousKangaroo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VictoriousKangaroo|null find($id, $lockMode = null, $lockVersion = null)
 * @method VictoriousKangaroo|null findOneBy(array $criteria, array $orderBy = null)
 * @method VictoriousKangaroo[]    findAll()
 * @method VictoriousKangaroo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VictoriousKangarooRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VictoriousKangaroo::class);
    }

    // /**
    //  * @return VictoriousKangaroo[] Returns an array of VictoriousKangaroo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VictoriousKangaroo
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
