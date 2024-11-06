<?php

namespace App\Repository;

use App\Entity\Violon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Violon>
 *
 * @method Violon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Violon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Violon[]    findAll()
 * @method Violon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViolonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Violon::class);
    }

//    /**
//     * @return Violon[] Returns an array of Violon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Violon
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
